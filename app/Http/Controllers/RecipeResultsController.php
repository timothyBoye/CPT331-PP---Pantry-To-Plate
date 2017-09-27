<?php

namespace App\Http\Controllers;

use App\IngredientRecipeMapping;
use App\UserRecipeRating;
use Illuminate\Http\Request;
use App\Ingredient;
use App\Recipe;
use Illuminate\Support\Facades\Auth;

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

    public function setRating(Request $request)
    {
        $recipe_id = $request['id'];
        $rating = $request['rating'];
        $user_id = Auth::id();
        $userRecipeRating = UserRecipeRating::where('recipe_id', '=', $recipe_id)
            ->where('user_id', '=', $user_id)
            ->first();
        if(!$userRecipeRating) {
            $userRecipeRating = UserRecipeRating::create(
                ['recipe_id' => $recipe_id,
                    'user_id' => $user_id,
                    'rating' => $rating]
            );
        } else {
            $userRecipeRating->rating = $rating;
        }
        $userRecipeRating->save();

        $recipe = Recipe::find($recipe_id);
        $ratings = UserRecipeRating::where('recipe_id', '=', $recipe_id )->get();
        $count = 0;
        $sum = 0;
        foreach ($ratings as $rating) {
            $count++;
            $sum += $rating->rating;
        }
        $recipe->average_rating = $sum/$count;
        $recipe->number_of_ratings = $count;
        $recipe->save();

        return response()->json(array('success' => true, 'html' => $userRecipeRating->user_id));
    }
}
