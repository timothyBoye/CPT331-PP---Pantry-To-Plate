<?php

namespace App\Http\Controllers;

use App\IngredientRecipeMapping;
use App\UserRecipeRating;
use Illuminate\Http\Request;
use App\Ingredient;
use App\Recipe;
use Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class RecipeResultsController extends Controller
{
    public function getResults(Request $request)
    {
        $this->validate(request(), [
            'ingredients.*.id' => 'required|numeric',
            'ingredients.*.name' => 'required|regex:/^[A-z\-\s]+$/',
            'ingredients.*.ingredient_image_url' => 'mimes:jpg,jpeg,bmp,png',
            'cuisineType' => 'numeric',
            'ratingFilterValue' => 'numeric',
            'cuisinePreference' => 'alpha',
            'ingredientFilterValue' => 'numeric',
            'ingredientsNeededFilterValue' => 'numeric'
        ]);

        $ingredients = $request['ingredients'];
        $cuisine_type_filter = $request['cuisineType'];
        $rating_filter_value = $request['ratingFilterValue'];
        $cuisine_preference_checked = $request['cuisinePreference'];
        $ingredient_filter_value =$request['ingredientFilterValue'];
        $ingredients_needed_filter_value =$request['ingredientsNeededFilterValue'];

        $returnHTML = null;
        $occurrences = $this->get_recipe_id_and_ingredient_frequency($ingredients, $cuisine_type_filter, $rating_filter_value, $ingredient_filter_value, $ingredients_needed_filter_value);
        $sorted_recipe_ids = [];

        // Strangely, the value coming from the checkbox is a string, not bool
        if($cuisine_preference_checked == 'true'){
            $preferences = Recipe::sort_recipe_ids_by_cuisine_algorithm($occurrences);
            foreach($preferences as $key => $val){
                array_push($sorted_recipe_ids, $key);
            }
        }
        else{
            foreach($occurrences as $key => $val) {
                array_push($sorted_recipe_ids, $key);
            }

        }

        $recipes = Recipe::get_recipes_from_ids($sorted_recipe_ids);
        $userRatings = UserRecipeRating::get_ratings_for_user($recipes);
        $returnHTML = $this->build_html($recipes, $userRatings, $occurrences);

        return response()->json(array('success' => true, 'html'=>$returnHTML), 200);
    }

    private function build_html($recipes, $userRatings, $occurrences){
        return view('recipe-list', compact('recipes', 'userRatings', 'occurrences'))->render();
    }

    private function get_recipe_id_and_ingredient_frequency($ingredients, $cuisine_type_filter, $rating_filter_value, $ingredient_filter_value, $ingredients_needed_filter_value){
        $ingredient_names = [];

        foreach ($ingredients as $ingredient) {
            array_push($ingredient_names, $ingredient['name']);
        }

        $ingredient_ids = IngredientRecipeMapping::get_matching_recipe_names($ingredient_names);
        $recipe_ids = IngredientRecipeMapping::get_matching_recipe_ids($ingredient_ids, $cuisine_type_filter, $rating_filter_value, $ingredient_filter_value);

        $occurrences = array_count_values($recipe_ids);
        arsort($occurrences);

        if($ingredients_needed_filter_value >= 1 ) {
            foreach ($occurrences as $key => $matchedIngredients) {
                $totalIngredients = count(Recipe::find($key)->ingredients);
                $ingredientsNeeded = $totalIngredients - $matchedIngredients;
                if ($ingredientsNeeded > $ingredients_needed_filter_value) {
                    unset($occurrences[$key]);
                }
            }
        }

        return $occurrences;

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
