<?php

namespace App\Http\Controllers;

use App\IngredientRecipeMapping;
use Illuminate\Http\Request;
use App\Ingredient;
use App\Recipe;

class RecipeResultsController extends Controller
{
    public function getResults(Request $request)
    {
        $ingredients = $request['ingredients'];

        $mappings = [];
        foreach($ingredients as $ingredient) {
            $ingredient_id = Ingredient::where('name', $ingredient)->value('id');
            array_push($mappings, IngredientRecipeMapping::where('ingredient_id', $ingredient_id)->get());
        }

        $recipes = [];
        foreach($mappings as $mapping) {
            foreach($mapping as $mapping_obj) {
                $recipe = Recipe::where('id', $mapping_obj->recipe_id)->get();
                if(!in_array($recipe, $recipes)){
                    array_push($recipes, $recipe);
                }
            }
        }

        return response()->json(array('recipes' => $recipes));
    }


    public function show($id)
    {
        $recipe = Recipe::find($id);
        if ($recipe) {
            return view('recipe', compact('recipe'));
        } else {
            return redirect()->route('home');
        }
    }
}
