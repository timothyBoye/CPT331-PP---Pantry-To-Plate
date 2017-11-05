<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\Config;

/**
 * Class Recipe
 *
 * Stores the image, ingredients, quantities, method and description for site recipes
 *
 * @package App\
 */

class Recipe extends Model
{
    // Columns
    protected $fillable = [
        'id', 'name', 'short_description', 'long_description', 'method', 'serving_size', 'cuisine_type_id', 'image_url', 'recipe_source'
    ];

    /**
     * Returns the ingredient recipe mappings that use this recipe
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ingredients()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }

    /**
     * Returns the cuisine type that this recipe belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cuisine_type()
    {
        return $this->belongsTo('App\CuisineType');
    }

    /**
     * Returns all user recipe ratings for this recipe
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany('App\UserRecipeRating');
    }

    /**
     * Returns this recipes nutritional panel
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nutritional_info_panel()
    {
        return $this->hasOne('App\NutritionalInfoPanel');
    }

    /**
     * Returns the recipe method steps for this recipe
     * @return mixed
     */
    public function method_steps()
    {
        return $this->hasMany('App\RecipeMethod', 'recipe_id', 'id')->orderBy('step_number');
    }

    /**
     * Returns the image name of this recipe, if this recipe doesn't have an image name than the default is returned
     * @return mixed|string
     */
    public function image_name()
    {
        return $this->image_url == '' ? 'default.jpg' : $this->image_url;
    }


    /**
     * Takes a set of recipe ids and returns an ordered array of matching recipe objects.
     * @param $recipe_ids
     * @return array
     */
    public static function get_recipes_from_ids($recipe_ids)
    {
        $recipes = [];
        foreach($recipe_ids as $recipe_id) {
            $recipe = Recipe::find($recipe_id);
            array_push($recipes, $recipe);
        }
        return $recipes;
    }


    /**
     * Should return a bunch of recipe ids which have been sorted based on the points system
     * used by the algorithm, so it's compatible with the current view
     * @param $occurrences
     * @return mixed
     */
    public static function sort_recipe_ids_by_cuisine_algorithm($occurrences)
    {
        if(!Auth::check()){
            return $occurrences;
        }
        $results = $occurrences;
        $cuisine_prefs = UserCuisineTypeMapping::where('user_id', Auth::user()->id)
            ->get();

        if($cuisine_prefs->count() > 0){
            $num_cuisines = $cuisine_prefs->count() - 1;

            foreach($occurrences as $key => $val){
                $recipe = Recipe::find($key);

                if($recipe->cuisine_type_id != null){
                    $cuisine = $cuisine_prefs->whereStrict('cuisine_type_id', $recipe->cuisine_type_id)->first();
                    $results[$key] += $num_cuisines - $cuisine->rating;
                }
            }

            arsort($results);

        }
        return $results;
    }
}
