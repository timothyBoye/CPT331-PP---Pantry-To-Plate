<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\Config;

class Recipe extends Model
{
    protected $fillable = [
        'id', 'name', 'short_description', 'long_description', 'method', 'serving_size', 'cuisine_type_id', 'image_url', 'recipe_source'
    ];

    public function ingredients()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }

    public function cuisine_type()
    {
        return $this->belongsTo('App\CuisineType');
    }

    public function ratings()
    {
        return $this->hasMany('App\UserRecipeRating');
    }

    public function nutritional_info_panel()
    {
        return $this->hasOne('App\NutritionalInfoPanel');
    }

    public static function get_recipes_from_ids($recipe_ids){
        $recipes = [];
        foreach($recipe_ids as $recipe_id) {
            $recipe = Recipe::find($recipe_id);
            array_push($recipes, $recipe);
        }
        return $recipes;
    }

    // Should return a bunch of recipe ids which have been sorted based on the points system
    // used by the algorithm, so it's compatible with the current view
    public static function sort_recipe_ids_by_cuisine_algorithm($occurrences){
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

    public function method_steps()
    {
        return $this->hasMany('App\RecipeMethod', 'recipe_id', 'id')->orderBy('step_number');
    }

}
