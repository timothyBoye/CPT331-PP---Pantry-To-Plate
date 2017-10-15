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

class AdminRecipesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }


    public function recipes(Request $request)
    {
        $title = "Recipes";
        $recipes = Recipe::all();
        if (session('recipe')) {
            $recipe = session('recipe');
            return view('admin.admin-recipes', compact('title', 'recipes', 'recipe'));
        } else {
            return view('admin.admin-recipes', compact('title', 'recipes'));
        }
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
