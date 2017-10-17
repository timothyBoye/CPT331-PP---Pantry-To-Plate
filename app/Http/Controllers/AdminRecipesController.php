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

class AdminRecipesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }


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

    public function recipesPost(Request $request)
    {
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

        $totalData = Recipe::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

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

        echo json_encode($json_data);
    }

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

    public function addRecipe(Request $request)
    {
        $title = 'Add Recipe';
        $cuisine_types = CuisineType::orderBy('name', 'asc')->get();
        return view('admin.admin-recipe-form-main', compact('title', 'cuisine_types'));
    }


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

    public function getIngredients($id, Request $request)
    {
        $recipe = Recipe::find($id);
        $measurement_types = MeasurementType::orderBy('name', 'asc')->get();
        $ingredients = Ingredient::orderBy('name', 'asc')->get();
        $title = 'Add Ingredients to '.$recipe->name;

        return view('admin.admin-recipe-form-ingredients', compact('recipe', 'measurement_types', 'ingredients', 'title'));
    }


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

    public function getMethods($id, Request $request)
    {
        $recipe = Recipe::find($id);

        $title = 'Add Method Steps to '.$recipe->name;
        return view('admin.admin-recipe-form-methods', compact('recipe', 'title'));
    }


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


    public function deleteRecipe($id, Request $request)
    {
        $recipe = Recipe::find($id);
        if ($recipe) {
            RecipeMethod::where('recipe_id', '=', $id)->delete();
            IngredientRecipeMapping::where('recipe_id', '=', $id)->delete();
            NutritionalInfoPanel::where('recipe_id', '=', $id)->delete();
            $recipe->delete();
            return redirect()->route('admin.recipes');
        } else {
            return redirect()->route('admin.recipes');
        }
    }


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
