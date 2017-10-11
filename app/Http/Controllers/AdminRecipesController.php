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
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminRecipeFormRequest;

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
        $title = 'Edit Recipe';
        $cuisine_types = CuisineType::orderBy('name', 'asc')->get();
        $measurement_types = MeasurementType::orderBy('name', 'asc')->get();
        $ingredients = Ingredient::orderBy('name', 'asc')->get();
        if ($recipe) {
            return view('admin.admin-recipes-form', compact('recipe', 'title', 'cuisine_types', 'measurement_types', 'ingredients'));
        } else {
            return redirect()->route('admin.recipes');
        }
    }

    public function addRecipe(Request $request)
    {
        $title = 'Add Recipe';
        $cuisine_types = CuisineType::orderBy('name', 'asc')->get();
        $measurement_types = MeasurementType::orderBy('name', 'asc')->get();
        $ingredients = Ingredient::orderBy('name', 'asc')->get();
        return view('admin.admin-recipes-form', compact('title', 'cuisine_types', 'measurement_types', 'ingredients'));
    }

    public function postRecipe(AdminRecipeFormRequest $request)
    {
        $recipe = Recipe::create(array(
            'name' => $request['name'],
            'short_description' => $request['short_description'],
            'long_description' => $request['long_description'],
            'serving_size' => $request['serving_size'],
            'cuisine_type_id' => $request['cuisine_type_id'],
            'image_url' => $request['image_url']
        ));
        $recipe->save();

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

        return redirect()->route('admin.recipes')->with(['recipe' => $recipe]);
    }

    public function putRecipe($id, AdminRecipeFormRequest $request)
    {
        $recipe = Recipe::find($id);
        $recipe->update(array(
            'name' => $request['name'],
            'short_description' => $request['short_description'],
            'long_description' => $request['long_description'],
            'serving_size' => $request['serving_size'],
            'cuisine_type_id' => $request['cuisine_type_id'],
            'image_url' => $request['image_url']
        ));
        $recipe->save();

        IngredientRecipeMapping::where('recipe_id', '=', $id)->delete();
        $ingredient_quantities = $request['ingredient_quantities'];
        $ingredient_names = $request['ingredient_names'];
        $ingredient_measures = $request['ingredient_measures'];
        $ingredient_descriptions = $request['ingredient_descriptions'];
        $count = count($ingredient_quantities);
        for ($i = 0; $i < $count; $i++) {
            $ingredient = IngredientRecipeMapping::create(array(
                'ingredient_id' => $ingredient_names[$i],
                'recipe_id' => $id,
                'measurement_type_id' => $ingredient_measures[$i],
                'quantity' => $ingredient_quantities[$i],
                'description' => $ingredient_descriptions[$i]
            ));
            $ingredient->save();
        }

        RecipeMethod::where('recipe_id', '=', $id)->delete();
        $method_descriptions = $request['method_descriptions'];
        $method_images = $request['method_images'];
        $count = count($method_descriptions);
        for ($i = 0; $i < $count; $i++) {
            $method = RecipeMethod::create(array(
                'recipe_id' => $id,
                'step_number' => $i+1,
                'description' => $method_descriptions[$i],
                'image_url' => $method_images[$i],
            ));
            $method->save();
        }

        $nutrition = NutritionalInfoPanel::where('recipe_id', '=', $id)->first();
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

        return redirect()->route('admin.recipes')->with(['recipe' => $recipe]);
    }

    public function deleteRecipe($id, Request $request)
    {
        $recipe = Recipe::find($id);
        if ($recipe) {
            $recipe->delete();
            return redirect()->route('admin.recipes');
        } else {
            return redirect()->route('admin.recipes');
        }
    }


    public function seedString(Request $request)
    {
        // Recipe
        $recipe_id = DB::table('recipes')->max('id') + 1;
        $response = $this->recipeSeedString($recipe_id, $request["name"], $request["short_description"],
            $request["long_description"], $request["serving_size"], $request["cuisine_type_id"], $request["image_url"]);

        // Ingredients
        $ingredient_quantities = $request['ingredient_quantities'];
        $ingredient_names = $request['ingredient_names'];
        $ingredient_measures = $request['ingredient_measures'];
        $ingredient_descriptions = $request['ingredient_descriptions'];
        $ingredientCount = count($ingredient_quantities);
        for ($i = 0; $i < $ingredientCount; $i++) {
            $response = $response.$this->ingredientSeedString($request["name"], $ingredient_quantities[$i],
                    $ingredient_names[$i], $ingredient_measures[$i], $ingredient_descriptions[$i]);
        }

        // Method
        $method_descriptions = $request['method_descriptions'];
        $method_images = $request['method_images'];
        $methodCount = count($request['method_descriptions']);
        for ($i = 0; $i < $methodCount; $i++) {
            $response = $response.$this->methodStepSeedString($request["name"], $i+1,
                    $method_descriptions[$i], $method_images[$i]);
        }

        // Nutrition
        $response = $response.$this->nutritionSeedString($request["name"], $request["gram_total_fat"], $request["gram_saturated_fat"],
                $request["gram_total_carbohydrates"], $request['gram_sugars'], $request["gram_fiber"],
                $request["mg_sodium"], $request["gram_protein"], $request["calories"]);

        // Return object strings
        return response()->json($response, 200);
    }

    private function methodStepSeedString($recipe_name, $step_number, $description, $image_url)
    {
        $response = "\App\RecipeMethod::create(array(";
        $response = $response."'recipe_id' => Recipe::where('name', '=', '$recipe_name')->value('id'), ";
        $response = $response."'step_number' => $step_number, ";
        $response = $response."'description' => '$description', ";
        $response = $response."'image_url' => '$image_url'";
        $response = $response."));\n";

        return $response;
    }

    private function recipeSeedString($id, $name, $short_description, $long_description,
                                      $serving_size, $cuisine_type_id, $image_url)
    {
        $response = "\App\Recipe::create(array(";
        $response = $response."'id' => $id, ";
        $response = $response."'name' => '$name', ";
        $response = $response."'short_description' => '$short_description', ";
        $response = $response."'long_description' => '$long_description', ";
        $response = $response."'serving_size' => '$serving_size', ";
        $cuisineType = CuisineType::where('id', '=', $cuisine_type_id)->value('name');
        $response = $response."'cuisine_type_id' => CuisineType::where('name', '=', '$cuisineType')->value('id'), ";
        $response = $response."'image_url' => '$image_url'";
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

    private function ingredientSeedString($recipe_name, $ingredient_quantity, $ingredient_name, $ingredient_measure, $ingredient_description)
    {
        $response = "\App\IngredientRecipeMapping::create(array(";
        $response = $response."'recipe_id' => Recipe::where('name', '=', '$recipe_name')->value('id'), ";
        $ingredientName = Ingredient::where('id', '=', $ingredient_name)->value('name');
        $response = $response."'ingredient_id' => Ingredient::where('name', '=', '$ingredientName')->value('id'), ";
        $ingredientMeasure = MeasurementType::where('id', '=', $ingredient_measure)->value('name');
        $response = $response."'measurement_type_id' => MeasurementType::where('name', '=', '$ingredientMeasure')->value('id'), ";
        $response = $response."'quantity' => '$ingredient_quantity', ";
        $response = $response."'description' => '$ingredient_description'";
        $response = $response."));\n";

        return $response;
    }
}
