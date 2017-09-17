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
        foreach($ingredients as $ingredient){
            $ingredient_id = Ingredient::where('name', $ingredient)->value('id');
            array_push($mappings, IngredientRecipeMapping::where('ingredient_id', $ingredient_id)->get());
        }

        $recipes = [];
        foreach($mappings as $mapping){
            foreach($mapping as $mapping_obj){
                array_push($recipes, Recipe::where('id', $mapping_obj->recipe_id)->get());
            }
        }

        return response()->json(array('recipes' => $recipes));
    }
}
