<?php

namespace App\Http\Controllers;

use App\IngredientRecipeMapping;
use App\UserRecipeRating;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Ingredient;
use App\Recipe;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

/**
 * Class RecipeResultsController
 *
 * This class provides our primary matching algorithm code and recipe displaying functionality
 *
 * @package App\Http\Controllers
 */
class RecipeResultsController extends Controller
{
    /**
     * This function accepts a number of data points from the user, finds recipes we believe match what the user is looking
     * for and orders the list by best match before returning the recipes to the view.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResults(Request $request)
    {
        // validate input
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

        // get the user parameters for matching
        $ingredients = $request['ingredients'];
        $cuisine_type_filter = $request['cuisineType'];
        $rating_filter_value = $request['ratingFilterValue'];
        $cuisine_preference_checked = $request['cuisinePreference'];
        $ingredient_filter_value =$request['ingredientFilterValue'];
        $ingredients_needed_filter_value =$request['ingredientsNeededFilterValue'];

        $returnHTML = null;
        $occurrences = $this->get_recipe_id_and_ingredient_frequency($ingredients, $cuisine_type_filter, $rating_filter_value, $ingredient_filter_value, $ingredients_needed_filter_value);
        $sorted_recipe_ids = [];

        // if the cuisine preferences check box is on we need to sort not just by occurrence but by cuisine
        if ($cuisine_preference_checked == 'true') // Strangely, the value coming from the checkbox is a string, not bool
        {
            $preferences = Recipe::sort_recipe_ids_by_cuisine_algorithm($occurrences);
            foreach($preferences as $key => $val) {
                array_push($sorted_recipe_ids, $key);
            }
        }
        // no need to sort by cuisine, just sort by occurrence
        else
        {
            foreach($occurrences as $key => $val) {
                array_push($sorted_recipe_ids, $key);
            }
        }

        // here we retrieve the recipes and sort them by our algorithms
        $recipes = Recipe::whereIn('id', $sorted_recipe_ids)->get()->sortBy(function($model) use ($sorted_recipe_ids) {
            return array_search($model->getKey(), $sorted_recipe_ids);
        });

        // This function pages the collection such that we can return only 10 items at a time.
        $recipes = $this->paginate($recipes, $perPage = 10, $page = Input::get('page', 1));

        // Grabs the user ratings of recipes
        $userRatings = UserRecipeRating::get_ratings_for_user($recipes);
        // Grabs the HTML render
        $returnHTML = $this->build_html($recipes, $userRatings, $occurrences);
        // finally returns the html to the view for displaying
        return response()->json(array('success' => true, 'html'=>$returnHTML), 200);
    }

    /**
     * This function creates an array for the recipes that contains how many ingredients each recipe has matched with.
     * This is used for sorting the display of recipes by most matches.
     *
     * @param $ingredients
     * @param $cuisine_type_filter
     * @param $rating_filter_value
     * @param $ingredient_filter_value
     * @param $ingredients_needed_filter_value
     * @return array
     */
    private function get_recipe_id_and_ingredient_frequency($ingredients, $cuisine_type_filter, $rating_filter_value, $ingredient_filter_value, $ingredients_needed_filter_value){
        $ingredient_names = [];

        foreach ($ingredients as $ingredient) {
            array_push($ingredient_names, $ingredient['name']);
        }

        $ingredient_ids = IngredientRecipeMapping::get_matching_recipe_names($ingredient_names);
        // retrieve recipes that use the selected ingredients and meet the specified filter values
        $recipe_ids = IngredientRecipeMapping::get_matching_recipe_ids($ingredient_ids, $cuisine_type_filter, $rating_filter_value, $ingredient_filter_value);

        // counts number of matched ingredients for each recipe and sorts them in descending order by that count value
        $occurrences = array_count_values($recipe_ids);
        arsort($occurrences);

        // removes any recipes that do not meet specified ingredients needed filter value
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

    /**
     * Paginator for a collection
     * https://gist.github.com/vluzrmos/3ce756322702331fdf2bf414fea27bcb
     *
     * @param array|Collection      $items
     * @param int   $perPage
     * @param int  $page
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * This helper function uses the recipe-list view page to build html from the set of recipes passed in for other
     * functions to use.
     *
     * @param $recipes
     * @param $userRatings
     * @param $occurrences
     * @return string
     */
    private function build_html($recipes, $userRatings, $occurrences){
        return view('recipe-list', compact('recipes', 'userRatings', 'occurrences'))->render();
    }

    /**
     * This function accepts an id and displays the detailed recipe page for the recipe that matched that id or if none
     * match the user is redirected home.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);

        // check the recipe exists and return the view
        if ($recipe) {
            $userRating = null;
            if (Auth::check()) {
                $userRating = UserRecipeRating::where('user_id', '=', Auth::id())
                    ->where('recipe_id', '=', $recipe->id)
                    ->first();
            }
            return view('recipe', compact('recipe', 'userRating'));
        // otherwise return the user home
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * This function receives a recipe id and rating from the user and then saves that rating to the database if
     * the user is logged in. If a rating for that user and recipe already exists it is overwritten.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setRating(Request $request)
    {
        $recipe_id = $request['id'];
        $rating = $request['rating'];
        $user_id = Auth::id();
        // check if a rating already exists
        $userRecipeRating = UserRecipeRating::where('recipe_id', '=', $recipe_id)
            ->where('user_id', '=', $user_id)
            ->first();
        // if there is no rating make one
        if(!$userRecipeRating) {
            $userRecipeRating = UserRecipeRating::create(
                ['recipe_id' => $recipe_id,
                    'user_id' => $user_id,
                    'rating' => $rating]
            );
        // otherwise update it
        } else {
            $userRecipeRating->rating = $rating;
        }
        // finally save the new/updated rating
        $userRecipeRating->save();

        /* Recalculate the average and number of raters for this recipe and save the new info to the database, this
           ensures that these computations are performed only once each time the data is added to rather than everytime
           a recipe is displayed. */
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

        // Return success!
        return response()->json(null, 200);
    }
}
