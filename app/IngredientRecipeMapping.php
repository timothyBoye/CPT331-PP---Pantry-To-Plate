<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IngredientRecipeMapping
 *
 * Maps values between the Ingredients and Recipes tables
 *
 * @package App\
 */
class IngredientRecipeMapping extends Model
{
    // Columns
    protected $fillable = [
        'recipe_id', 'ingredient_id', 'measurement_type_id', 'quantity', 'description'
    ];

    /**
     * Returns the name of the ingredient that this mapping relates to for displaying to the user, if the mapping
     * relates to a quantity greater than 1 it returns the plural form of the ingredient name.
     * @return mixed
     */
    public function ingredient_name()
    {
        if ($this->ingredient->plural != '' && $this->quantity > 1) {
            return $this->ingredient->plural;
        } else {
            return $this->ingredient->name;
        }
    }

    /**
     * Returns the recipe that this mapping relates to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }

    /**
     * Returns the ingredient that this mapping relates to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ingredient()
    {
        return $this->belongsTo('App\Ingredient');
    }

    /**
     * Returns the measurement type that this mapping relates to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function measure()
    {
        return $this->belongsTo('App\MeasurementType', 'measurement_type_id', 'id');
    }

    /**
     * Takes an array of ingredient ids and the user's filter values.
     * Finds recipe ids that contain any of the listed ingredients and filters out any recipes
     * that do not meet the filter criteria. Returns recipe ids that satisfy criteria via an array.
     *
     * @param $ingredient_ids
     * @param $cuisine_type_filter
     * @param $rating_filter_value
     * @param $ingredient_filter_value
     * @return array
     */
    public static function get_matching_recipe_ids($ingredient_ids, $cuisine_type_filter, $rating_filter_value, $ingredient_filter_value)
    {
        $recipe_ids = [];

        foreach ($ingredient_ids as $id) {
            // Find recipe ids that contain any of the ingredients specified
            foreach (IngredientRecipeMapping::select('recipe_id')
                         ->where('ingredient_id', '=', $id)->get() as $ingredient_recipe_mapping) {
                $include = true;
                // Apply the cuisine type filter set by the user
                if($cuisine_type_filter > 0){
                    if($ingredient_recipe_mapping->recipe->cuisine_type_id != $cuisine_type_filter){
                        $include = false;
                    }
                }
                // Apply the star rating filter value
                if($rating_filter_value >= 0){
                    if(round($ingredient_recipe_mapping->recipe->average_rating) < $rating_filter_value){
                        $include = false;
                    }
                }
                // Apply the filter value for total number of ingredients in the recipe
                if($ingredient_filter_value >= 1){
                    $ingCount = count($ingredient_recipe_mapping->recipe->ingredients);
                    $include_on_filter = true;
                    if($ingCount != $ingredient_filter_value) {
                        $include_on_filter = false;
                    }
                    if($ingCount > 9 and $ingredient_filter_value == 10) {
                        $include_on_filter = true;

                    }
                    $include = $include && $include_on_filter;

                }
                // Return recipes that meet all relevant criteria in an array
                if($include){
                    array_push($recipe_ids, $ingredient_recipe_mapping->recipe_id);

                }

            }
        }

        return $recipe_ids;

    }


    /**
     * Queries Ingredients table for the ingredient ids for a given array of ingredient names
     * @param $ingredient_names
     * @return array
     */
    public static function get_matching_recipe_names($ingredient_names)
    {
        $ingredient_ids = [];

        foreach ($ingredient_names as $name) {
            foreach (Ingredient::select(['name', 'id'])
                         ->where('name', 'LIKE', '%'.$name.'%')->get() as $ingredient) {
                    array_push($ingredient_ids, $ingredient->id);
                }
        }
        return $ingredient_ids;

    }
}
