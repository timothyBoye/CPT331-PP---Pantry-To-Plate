<?php

namespace App\Http\Controllers;

use App\IngredientRecipeMapping;
use App\UserRecipeRating;
use Illuminate\Http\Request;
use App\Ingredient;
use App\Recipe;

use Illuminate\Support\Facades\DB;

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
                array_push($recipe_ids, $recipe_id->recipe_id);
            }
        }

        $occurrences = array_count_values($recipe_ids);
        arsort($occurrences);

        $sorted_recipe_ids = [];
        foreach($occurrences as $key => $val) {
            array_push($sorted_recipe_ids, $key);
        }

        $recipes = [];
        $userRatings = [];
        foreach($sorted_recipe_ids as $recipe_id) {
            $recipe = Recipe::find($recipe_id);
            if (Auth::check()) {
                $userRating = UserRecipeRating::where('recipe_id', '=', $recipe->id)
                    ->where('user_id', '=', Auth::id())
                    ->first();
                if ($userRating) {
                    array_push($userRatings, $userRating);
                }
            }
            array_push($recipes, $recipe);
        }

        $returnHTML = view('recipe-list', compact('recipes', 'userRatings', 'occurrences'))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML), 200);
    }


    public function show($id)
    {
        $recipe = Recipe::find($id);

        if ($recipe) {
            $userRating = null;
            if (Auth::check()) {
                $userRating = UserRecipeRating::where('user_id', '=', Auth::id())
                    ->where('recipe_id', '=', $recipe->id)
                    ->first();
            }
            return view('recipe', compact('recipe', 'userRating'));
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

        return response()->json(null, 200);
    }
}
