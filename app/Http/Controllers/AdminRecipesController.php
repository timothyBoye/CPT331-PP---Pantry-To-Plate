<?php

namespace App\Http\Controllers;

use App\CuisineType;
use App\Ingredient;
use App\IngredientCategory;
use App\IngredientRecipeMapping;
use App\MeasurementType;
use App\NutritionalInfoPanel;
use App\Recipe;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminRecipesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }


    public function recipes(Request $request)
    {
        $title = "Recipes";
        $recipes = Recipe::paginate(10);
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
        $cuisine_types = CuisineType::all();
        $measurement_types = MeasurementType::all();
        $ingredients = Ingredient::all();
        if ($recipe) {
            return view('admin.admin-recipes-form', compact('recipe', 'title', 'cuisine_types', 'measurement_types', 'ingredients'));
        } else {
            return redirect()->route('admin.recipes');
        }
    }

    public function addRecipe(Request $request)
    {
        $title = 'Add Recipe';
        $cuisine_types = CuisineType::all();
        $measurement_types = MeasurementType::all();
        $ingredients = Ingredient::all();
        return view('admin.admin-recipes-form', compact('title', 'cuisine_types', 'measurement_types', 'ingredients'));
    }

    public function postRecipe(Request $request)
    {
        $method = $this->collapseMethod($request['methods']);
        $recipe = Recipe::create(array(
            'name' => $request['name'],
            'short_description' => $request['short_description'],
            'long_description' => $request['long_description'],
            'serving_size' => $request['serving_size'],
            'method' => $method,
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

    public function putRecipe($id, Request $request)
    {
        $method = $this->collapseMethod($request['methods']);
        $recipe = Recipe::find($id);
        $recipe->update(array(
            'name' => $request['name'],
            'short_description' => $request['short_description'],
            'long_description' => $request['long_description'],
            'serving_size' => $request['serving_size'],
            'method' => $method,
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

    private function collapseMethod($stepsArray)
    {
        $method = '';
        $stepCount = count($stepsArray);
        for ($i = 0; $i < $stepCount; $i++) {
            $method = $method . $stepsArray[$i];
            if ($stepCount != ($i + 1)) {
                $method = $method . Config::get('constants.recipe_method_delimiter');
            }
        }
        return $method;
    }

    public function seedString(Request $request)
    {
        $method = $this->collapseMethod($request['methods']);
        $recipe_id = DB::table('recipes')->max('id') + 1;

        $response = "\App\Recipe::create(array(";
        $response = $response."'id' => '".$recipe_id."', ";
        $response = $response."'name' => '".$request["name"]."', ";
        $response = $response."'short_description' => '".$request["short_description"]."', ";
        $response = $response."'long_description' => '".$request["long_description"]."', ";
        $response = $response."'method' => '".$method."', ";
        $response = $response."'serving_size' => '".$request["serving_size"]."', ";
        $response = $response."'cuisine_type_id' => '".$request["cuisine_type_id"]."', ";
        $response = $response."'image_url' => '".$request["image_url"]."'";
        $response = $response."));\n";

        $ingredient_quantities = $request['ingredient_quantities'];
        $ingredient_names = $request['ingredient_names'];
        $ingredient_measures = $request['ingredient_measures'];
        $ingredient_descriptions = $request['ingredient_descriptions'];
        $count = count($ingredient_quantities);
        for ($i = 0; $i < $count; $i++) {
            $response = $response."\App\IngredientRecipeMapping::create(array(";
            $response = $response."'recipe_id' => '".$recipe_id."', ";
            $response = $response."'ingredient_id' => '".$ingredient_names[$i]."', ";
            $response = $response."'measurement_type_id' => '".$ingredient_measures[$i]."', ";
            $response = $response."'quantity' => '".$ingredient_quantities[$i]."', ";
            $response = $response."'description' => '".$ingredient_descriptions[$i]."'";
            $response = $response."));\n";
        }

        $response = $response."\App\NutritionalInfoPanel::create(array(";
        $response = $response."'recipe_id' => '".$recipe_id."', ";
        $response = $response."'gram_total_fat' => '".$request["gram_total_fat"]."', ";
        $response = $response."'gram_saturated_fat' => '".$request["gram_saturated_fat"]."', ";
        $response = $response."'gram_total_carbohydrates' => '".$request["gram_total_carbohydrates"]."', ";
        $response = $response."'gram_sugars' => '".$request['gram_sugars']."', ";
        $response = $response."'gram_fiber' => '".$request["gram_fiber"]."', ";
        $response = $response."'mg_sodium' => '".$request["mg_sodium"]."', ";
        $response = $response."'gram_protein' => '".$request["gram_protein"]."', ";
        $response = $response."'calories' => '".$request["calories"]."'";
        $response = $response."));";

        return response()->json($response, 200);
    }
}
