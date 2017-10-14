<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class IngredientRecipeMapping extends Model
{
    protected $fillable = [
        'recipe_id', 'ingredient_id', 'measurement_type_id', 'quantity', 'description'
    ];

    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }

    public function ingredient()
    {
        return $this->belongsTo('App\Ingredient');
    }

    public function measure()
    {
        return $this->belongsTo('App\MeasurementType', 'measurement_type_id', 'id');
    }

    public static function get_matching_recipe_ids($ingredient_ids, $cuisine_type_filter, $rating_filter_value){
        $recipe_ids = [];

        foreach ($ingredient_ids as $id) {

            foreach (IngredientRecipeMapping::select('recipe_id')
                         ->where('ingredient_id', '=', $id)->get() as $ingredient_recipe_mapping) {
                $include = true;

                if($cuisine_type_filter > 0){
                    if($ingredient_recipe_mapping->recipe->cuisine_type_id != $cuisine_type_filter){
                        $include = false;
                    }
                }

                if($rating_filter_value >= 0){
                    if(round($ingredient_recipe_mapping->recipe->average_rating) < $rating_filter_value){
                        $include = false;
                    }
                }

                if($include){
                    array_push($recipe_ids, $ingredient_recipe_mapping->recipe_id);

                }

            }
        }

        return $recipe_ids;

    }

    public static function get_matching_recipe_names($ingredient_names){
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
