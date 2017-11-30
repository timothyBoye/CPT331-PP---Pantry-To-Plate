<?php

namespace App\Http\Controllers;

use App\CuisineType;
use App\Ingredient;
use App\IngredientCategory;
use App\IngredientRecipeMapping;
use App\MeasurementType;
use App\NutritionalInfoPanel;
use App\Recipe;
use App\RecipeMethod;
use App\RecipeUserMapping;
use App\User;
use App\UserRole;
use App\Utilities;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminRecipeFormRequest;
use App\Http\Requests\RecipeMethodsFormRequest;
use App\Http\Requests\RecipeIngredientsFormRequest;
use Symfony\Component\Finder\Tests\Iterator\ExcludeDirectoryFilterIteratorTest;

/**
 * Class AdminRecipesController
 *
 * Provides both view display and CRUD functionality for recipes
 *
 * @package App\Http\Controllers
 */
class AdminRecipesController extends Controller
{
    /**
     * AdminRecipesController constructor.
     * This method ensures the user is both logged in AND an admin user otherwise the auth middleware will redirect them away
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * This function displays the recipes table view for the admin dashboard which is a table of all ingredients in the DB with
     * add/edit/delete buttons.
     *
     * Note: this function does not pass recipes data to the view instead this is handled by a separate AJAX post method to allow
     * for pagination, searching and sorting.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recipes(Request $request)
    {

        $title = "Recipes";
        if (session('recipe')) {
            $recipe = session('recipe');
            return view('admin.admin-recipes', compact('title', 'recipe'));
        } else {
            return view('admin.admin-recipes', compact('title'));
        }
    }

    /**
     * This function handles post requests from the recipes table view to populate and sort the table.
     *
     * @param Request $request
     */
    public function recipesPost(Request $request)
    {
        // Sortable columns
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'cuisine_type_name',
            3 => 'short_description',
            4 => 'ingredient_count',
            5 => 'steps_count',
            6 => 'average_rating',
            7 => 'number_of_ratings'
        );

        // Get how many items there are in the collection to return to the client for displaying
        $totalData = Recipe::count();
        $totalFiltered = $totalData;

        // Table parameters for filtering and sorting received from the client request
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        // retrieve all data if no search terms were provided
        if(empty($request->input('search.value'))) {
            $recipes = Recipe::offset($start)
                ->leftJoin('cuisine_types', 'cuisine_types.id', '=', 'cuisine_type_id')
                ->leftJoin('ingredient_recipe_mappings', 'ingredient_recipe_mappings.recipe_id', '=', 'recipes.id')
                ->leftJoin('recipe_methods', 'recipe_methods.recipe_id', '=', 'recipes.id')
                ->select('recipes.id as id', 'recipes.name as name', 'recipes.short_description as short_description',
                    'recipes.average_rating as average_rating', 'recipes.number_of_ratings as number_of_ratings',
                    'cuisine_types.name as cuisine_type_name', DB::raw('COUNT(DISTINCT(ingredient_recipe_mappings.ingredient_id)) as ingredient_count, COUNT(DISTINCT(recipe_methods.id)) as steps_count'))
                ->limit($limit)
                ->groupBy('recipes.name')
                ->orderBy($order,$dir)
                ->get();
        }
        // otherwise filter the collection based on the search terms
        else {
            $search = $request->input('search.value');

            $recipes =  Recipe::offset($start)
                ->leftJoin('cuisine_types', 'cuisine_types.id', '=', 'cuisine_type_id')
                ->leftJoin('ingredient_recipe_mappings', 'ingredient_recipe_mappings.recipe_id', '=', 'recipes.id')
                ->leftJoin('recipe_methods', 'recipe_methods.recipe_id', '=', 'recipes.id')
                ->select('recipes.id as id', 'recipes.name as name', 'recipes.short_description as short_description',
                    'recipes.average_rating as average_rating', 'recipes.number_of_ratings as number_of_ratings',
                    'cuisine_types.name as cuisine_type_name', DB::raw('COUNT(DISTINCT(ingredient_recipe_mappings.ingredient_id)) as ingredient_count, COUNT(DISTINCT(recipe_methods.id)) as steps_count'))
                ->groupBy('recipes.name')
                ->limit($limit)
                ->where('recipes.id','LIKE',"%{$search}%")
                ->orWhere('recipes.name', 'LIKE',"%{$search}%")
                ->orWhere('recipes.short_description', 'LIKE',"%{$search}%")
                ->orWhere('cuisine_types.name', 'LIKE',"%{$search}%")
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = count($recipes);
        }

        // if results were found above to display, render the row for the table for each result.
        $data = array();
        if(!empty($recipes))
        {
            foreach ($recipes as $recipe)
            {
                $csrf_field = csrf_field();

                $nestedData['id'] = $recipe->id;
                $nestedData['name'] = $recipe->name;
                $nestedData['cuisine_type_name'] = $recipe->cuisine_type_name;
                $nestedData['short_description'] = $recipe->short_description;
                $nestedData['ingredient_count'] = $recipe->ingredient_count;
                $nestedData['steps_count'] = $recipe->steps_count;
                $nestedData['average_rating'] = $recipe->average_rating;
                $nestedData['number_of_ratings'] = $recipe->number_of_ratings;
                // edit button
                $edit = route('admin.recipe.get', ['id' => $recipe->id]);
                $nestedData['edit'] = <<<EDIT
                    <form class="admin-table-buttons" action="{$edit}" method="GET">
                        {$csrf_field}
                        <button class="btn btn-info btn-sm" type="submit">Edit</button>
                    </form>
EDIT;

                // seed button
                $seed = route('admin.recipe.seeder', ['id' => $recipe->id]);
                $nestedData['seed'] = <<<SEED
                    <form id="seed_form_{$recipe->id}" class="admin-table-buttons" action="" method="POST">
                        {$csrf_field}
                        <button id="seed_button_{$recipe->id}" data-api-controller-url="{$seed}" class="btn btn-default btn-sm" type="button">Seed String</button>
                        <script>
                            $('#seed_button_{$recipe->id}').click(function(){
                                console.log('click');
                                $.ajax({
                                    url: $('#seed_button_{$recipe->id}').attr('data-api-controller-url'),
                                    type: 'POST',
                                    data: $('#seed_form_{$recipe->id}').serialize()
                                }).done(function(response){
                                    $('#seed_string').html('<pre>'+response+'</pre>');
                                }).fail(function(response){
                                    $('#seed_string').html(response.responseText);
                                });
                            });
                        </script>
                    </form>
SEED;

                // delete button
                $delete = route('admin.recipe.delete', ['id' => $recipe->id]);
                $delete_filed = method_field('DELETE');
                $nestedData['delete'] = <<<DELETE
                    <form class="admin-table-buttons" action="{$delete}" method="POST">
                        {$delete_filed}
                        {$csrf_field}
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
DELETE;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        // Return the data to the view to be displayed in the table
        echo json_encode($json_data);
    }

    /**
     * This function accepts an id value and displays the matching recipe in the recipe form for both
     * viewing and editing.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getRecipe($id, Request $request)
    {
        $recipe = Recipe::find($id);
        NutritionalInfoPanel::firstOrCreate(['recipe_id' => $recipe->id]);
        $title = 'Edit Recipe';
        $cuisine_types = CuisineType::orderBy('name', 'asc')->get();
        if ($recipe) {
            return view('admin.admin-recipe-form-main', compact('recipe', 'title', 'cuisine_types'));
        } else {
            return redirect()->route('admin.recipes');
        }
    }

    /**
     * This function provides a blank recipe form for entering a new recipe.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addRecipe(Request $request)
    {
        $title = 'Add Recipe';
        $cuisine_types = CuisineType::orderBy('name', 'asc')->get();
        return view('admin.admin-recipe-form-main', compact('title', 'cuisine_types'));
    }

    /**
     * When a new recipe is posted by the client this function saves that recipe to the database and redirects
     * the client to the ingredient mappings form.
     *
     * Note: as we are using a custom request object AdminRecipeFormRequest we can assume here the recipe is valid
     * as the request object has already validated it.
     *
     * @param AdminRecipeFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecipe(AdminRecipeFormRequest $request)
    {
        $recipe = Recipe::create($request->all());
        $recipe->save();

        if( $request->hasFile('image')) {
            $imageName = Utilities::stripBadFileCharacters($recipe->name) . '.' .
                $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move(base_path() . '/public/img/recipes/', $imageName);

            $recipe->update(array('image_url'=>$imageName));
            $recipe->save();
        }

        $nutrition = NutritionalInfoPanel::create(array(
            'recipe_id'=>$recipe->id,
            'gram_total_fat'=>$request['gram_total_fat'],
            'gram_saturated_fat'=>$request['gram_saturated_fat'],
            'gram_total_carbohydrates'=>$request['gram_total_carbohydrates'],
            'gram_sugars'=>$request['gram_sugars'],
            'gram_fiber'=>$request['gram_fiber'],
            'mg_sodium'=>$request['mg_sodium'],
            'gram_protein'=>$request['gram_protein'],
            'calories' => $request['calories']
        ));
        $nutrition->save();

        $measurement_types = MeasurementType::orderBy('name', 'asc')->get();
        $ingredients = Ingredient::orderBy('name', 'asc')->get();
        $title = 'Add Ingredients to '.$recipe->name;

        return view('admin.admin-recipe-form-ingredients', compact('recipe', 'measurement_types', 'ingredients', 'title'));
    }


    /**
     * When the client returns updated values for a Recipe via a put call this method updates the database and
     * returns the user to the Recipes table with a success message.
     *
     * Note: as we are using a custom request object AdminRecipeFormRequest we can assume here the Recipe is valid
     * as the request object has already validated it.
     *
     * @param $id
     * @param AdminRecipeFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putRecipe($id, AdminRecipeFormRequest $request)
    {
        $recipe = Recipe::find($id);
        $recipe->update(array(
            'name' => $request['name'],
            'recipe_source' => $request['recipe_source'],
            'short_description' => $request['short_description'],
            'long_description' => $request['long_description'],
            'serving_size' => $request['serving_size'],
            'cuisine_type_id' => $request['cuisine_type_id'],
        ));
        $recipe->save();

        $nutrition = NutritionalInfoPanel::firstOrNew(['recipe_id' => $id]);
        $nutrition->update(array(
            'gram_total_fat'=>$request['gram_total_fat'],
            'gram_saturated_fat'=>$request['gram_saturated_fat'],
            'gram_total_carbohydrates'=>$request['gram_total_carbohydrates'],
            'gram_sugars'=>$request['gram_sugars'],
            'gram_fiber'=>$request['gram_fiber'],
            'mg_sodium'=>$request['mg_sodium'],
            'gram_protein'=>$request['gram_protein'],
            'calories' => $request['calories']
        ));
        $nutrition->save();

        return redirect()->route('admin.recipe.ingredients.get', ['id' => $recipe->id]);
    }

    /**
     * When a delete request is received from the client this message looks for the id in the database, deletes the row
     * and then returns the user to the recipes table view.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRecipe($id, Request $request)
    {
        $recipe = Recipe::find($id);
        if ($recipe) {
            RecipeMethod::where('recipe_id', '=', $id)->delete();
            IngredientRecipeMapping::where('recipe_id', '=', $id)->delete();
            NutritionalInfoPanel::where('recipe_id', '=', $id)->delete();
            RecipeUserMapping::where('recipe_id', '=', $id)->delete();
            $recipe->delete();
            return redirect()->route('admin.recipes');
        } else {
            return redirect()->route('admin.recipes');
        }
    }

    /**
     * This function accepts an id value and displays the matching ingredients for the given recipe in the recipe
     * ingredients form for both viewing and editing.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIngredients($id, Request $request)
    {
        $recipe = Recipe::find($id);
        $measurement_types = MeasurementType::orderBy('name', 'asc')->get();
        $ingredients = Ingredient::orderBy('name', 'asc')->get();
        $title = 'Add Ingredients to '.$recipe->name;

        return view('admin.admin-recipe-form-ingredients', compact('recipe', 'measurement_types', 'ingredients', 'title'));
    }

    /**
     * When a recipe ingredients form is posted by the client this function deletes any previous ingredients and saves
     * the posted ingreident mappings to the database then forwards the user to the methods form
     *
     * Note: as we are using a custom request object RecipeIngredientsFormRequest we can assume here the mappings are valid
     * as the request object has already validated it.
     *
     * @param $id
     * @param RecipeIngredientsFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecipeIngredients($id, RecipeIngredientsFormRequest $request)
    {
        $recipe = Recipe::find($id);

        IngredientRecipeMapping::where('recipe_id', '=', $id)->delete();

        $ingredient_quantities = $request['ingredient_quantities'];
        $ingredient_names = $request['ingredient_names'];
        $ingredient_measures = $request['ingredient_measures'];
        $ingredient_descriptions = $request['ingredient_descriptions'];

        $count = count($ingredient_quantities);
        for ($i = 0; $i < $count; $i++) {
            $ingredient = IngredientRecipeMapping::create(array(
                'ingredient_id' => $ingredient_names[$i],
                'recipe_id' => $recipe->id,
                'measurement_type_id' => $ingredient_measures[$i],
                'quantity' => $ingredient_quantities[$i],
                'description' => $ingredient_descriptions[$i]
            ));
            $ingredient->save();
        }

        return redirect()->route('admin.recipe.methods.get', ['id' => $recipe->id]);
    }

    /**
     * This function accepts an id value and displays the matching method steps for the given recipe in the recipe
     * method steps form for both viewing and editing.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMethods($id, Request $request)
    {
        $recipe = Recipe::find($id);

        $title = 'Add Method Steps to '.$recipe->name;
        return view('admin.admin-recipe-form-methods', compact('recipe', 'title'));
    }

    /**
     * When a recipe method steps form is posted by the client this function deletes any previous steps and saves
     * the posted steps to the database then forwards the user to recipes table with a success message.
     *
     * Note: as we are using a custom request object RecipeMethodsFormRequest we can assume here the steps are valid
     * as the request object has already validated it.
     *
     * @param $id
     * @param RecipeMethodsFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecipeMethods($id, RecipeMethodsFormRequest $request)
    {
        $recipe = Recipe::find($id);

        RecipeMethod::where('recipe_id', '=', $id)->delete();

        $method_descriptions = $request['method_descriptions'];
        $method_images = $request['method_images'];
        $count = count($method_descriptions);
        for ($i = 0; $i < $count; $i++) {
            $method = RecipeMethod::create(array(
                'recipe_id' => $recipe->id,
                'step_number' => $i+1,
                'description' => $method_descriptions[$i],
                'image_url' => $method_images[$i],
            ));
            $method->save();
        }

        return redirect()->route('admin.recipes')->with(['recipe' => $recipe]);
    }

    /**
     * This method is used by the development team to convert a database entry into a string that can be pasted into the seed
     * database files such that when php artisan db:seed is called this new entry is seeded to the database and not lost.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function seedString($id, Request $request)
    {
        // Recipe
        $recipe = Recipe::find($id);
        $response = $this->recipeSeedString($recipe->id, $recipe->name, $recipe->recipe_source, $recipe->short_description,
            $recipe->long_description, $recipe->serving_size, $recipe->cuisine_type_id, $recipe->image_url);

        // Ingredients
        foreach ($recipe->ingredients as $ingredient) {
            $response = $response.$this->ingredientSeedString($recipe->name, $ingredient->quantity,
                    $ingredient->ingredient_id, $ingredient->measurement_type_id, $ingredient->description, $recipe->ingredient_image_url);
        }

        // Method
        $count = 1;
        foreach ($recipe->method_steps as $step) {
            $response = $response.$this->methodStepSeedString($recipe->name, $count, $step->description, $step->image_url);
            $count++;
        }

        // Nutrition
        $nutrition = NutritionalInfoPanel::firstorcreate(['recipe_id' => $recipe->id]);
        $response = $response.$this->nutritionSeedString($recipe->name, $nutrition->gram_total_fat, $nutrition->gram_saturated_fat,
                $nutrition->gram_total_carbohydrates, $nutrition->gram_sugars, $nutrition->gram_fiber,
                $nutrition->mg_sodium, $nutrition->gram_protein, $nutrition->calories);

        // Return object strings
        return response()->json($response, 200);
    }

    /**
     * Helper method for seedString() that outputs a string for a RecipeMethod object
     *
     * @param $recipe_name
     * @param $step_number
     * @param $description
     * @param $image_url
     * @return string
     */
    private function methodStepSeedString($recipe_name, $step_number, $description, $image_url)
    {
        $response = "\App\RecipeMethod::create(array(";
        $response = $response."'recipe_id' => Recipe::where('name', '=', '$recipe_name')->value('id'), ";
        $response = $response."'step_number' => $step_number, ";
        $response = $response."'description' => '$description'";
        $response = $response."'image_url' => '$image_url'";
        $response = $response."));\n";

        return $response;
    }

    /**
     * Helper method for seedString() that outputs a string for a Recipe object
     * @param $id
     * @param $name
     * @param $recipe_source
     * @param $short_description
     * @param $long_description
     * @param $serving_size
     * @param $cuisine_type_id
     * @param $image
     * @return string
     */
    private function recipeSeedString($id, $name, $recipe_source, $short_description, $long_description,
                                      $serving_size, $cuisine_type_id, $image)
    {
        $response = "\App\Recipe::create(array(";
        $response = $response."'id' => $id, ";
        $response = $response."'name' => '$name', ";
        $response = $response."'recipe_source' => '$recipe_source', ";
        $response = $response."'short_description' => '$short_description', ";
        $response = $response."'long_description' => '$long_description', ";
        $response = $response."'serving_size' => '$serving_size', ";
        $cuisineType = CuisineType::where('id', '=', $cuisine_type_id)->value('name');
        $response = $response."'cuisine_type_id' => CuisineType::where('name', '=', '$cuisineType')->value('id'), ";
        $response = $response."'image_url' => '$image'";
        $response = $response."));\n";

        return $response;
    }

    /**
     * Helper method for seedString() that outputs a NutritionalInfoPanel object
     * @param $recipe_name
     * @param $gram_total_fat
     * @param $gram_saturated_fat
     * @param $gram_total_carbohydrates
     * @param $gram_sugars
     * @param $gram_fiber
     * @param $mg_sodium
     * @param $gram_protein
     * @param $calories
     * @return string
     */
    private function nutritionSeedString($recipe_name, $gram_total_fat, $gram_saturated_fat, $gram_total_carbohydrates,
                                         $gram_sugars, $gram_fiber, $mg_sodium, $gram_protein, $calories)
    {
        $response = "\App\NutritionalInfoPanel::create(array(";
        $response = $response."'recipe_id' => Recipe::where('name', '=', '$recipe_name')->value('id'), ";
        $response = $response."'gram_total_fat' => '$gram_total_fat', ";
        $response = $response."'gram_saturated_fat' => '$gram_saturated_fat', ";
        $response = $response."'gram_total_carbohydrates' => '$gram_total_carbohydrates', ";
        $response = $response."'gram_sugars' => '$gram_sugars', ";
        $response = $response."'gram_fiber' => '$gram_fiber', ";
        $response = $response."'mg_sodium' => '$mg_sodium', ";
        $response = $response."'gram_protein' => '$gram_protein', ";
        $response = $response."'calories' => '$calories'";
        $response = $response."));\n";

        return $response;
    }

    /**
     * Helper method for seedString() that outputs a string for an IngredientRecipeMapping object
     * @param $recipe_name
     * @param $ingredient_quantity
     * @param $ingredient_id
     * @param $ingredient_measure
     * @param $ingredient_description
     * @return string
     */
    private function ingredientSeedString($recipe_name, $ingredient_quantity, $ingredient_id, $ingredient_measure, $ingredient_description)
    {
        $response = "\App\IngredientRecipeMapping::create(array(";
        $response = $response."'recipe_id' => Recipe::where('name', '=', '$recipe_name')->value('id'), ";
        $ingredientName = Ingredient::where('id', '=', $ingredient_id)->value('name');
        $response = $response."'ingredient_id' => Ingredient::where('name', '=', '$ingredientName')->value('id'), ";
        $ingredientMeasure = MeasurementType::where('id', '=', $ingredient_measure)->value('name');
        $response = $response."'measurement_type_id' => MeasurementType::where('name', '=', '$ingredientMeasure')->value('id'), ";
        $response = $response."'quantity' => '$ingredient_quantity', ";
        $response = $response."'description' => '$ingredient_description'";
        $response = $response."));\n";

        return $response;
    }
}
