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
        $ingredient_ids = [];
        foreach ($ingredients as $ingredient) {
            array_push($ingredient_ids, Ingredient::where('name', $ingredient)->value('id'));
        }
        $recipe_ids = [];
        foreach ($ingredient_ids as $id) {
            foreach (IngredientRecipeMapping::select('recipe_id')->where('ingredient_id', '=', $id)->get() as $recipe_id) {
                if (!in_array($recipe_id->recipe_id, $recipe_ids)) {
                    array_push($recipe_ids, $recipe_id->recipe_id);
                }
            }
        }
        $recipes = Recipe::findMany($recipe_ids);

        $returnHTML = view('recipe-list', compact('recipes'))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

//        $mappings = [];
//        foreach($ingredients as $ingredient) {
//            $ingredient_id = Ingredient::where('name', $ingredient)->value('id');
//            array_push($mappings, IngredientRecipeMapping::where('ingredient_id', $ingredient_id)->get());
//        }
//
//        $recipes = [];
//        foreach($mappings as $mapping) {
//            foreach($mapping as $mapping_obj) {
//                $recipe = Recipe::where('id', $mapping_obj->recipe_id)->get();
//                if(!in_array($recipe, $recipes)){
//                    array_push($recipes, $recipe);
//                }
//            }
//        }
//        return response()->json(array('recipes' => $recipes));
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
