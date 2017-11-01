<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Ingredient
 *
 * Stores information regarding ingredients
 *
 * @package App\
 */

class Ingredient extends Model
{
    // Columns
    protected $fillable = [
       'id', 'name', 'ingredient_category_id', 'ingredient_image_url'
    ];

    // Relationship with Ingredient Category Model
    public function category()
    {
        return $this->belongsTo('App\IngredientCategory', 'ingredient_category_id', 'id');
    }

    // Relationship with IngredientRecipeMapping Model
    public function recipes()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }

    // Retrieve path for an ingredient image
    public function image_name()
    {
        return $this->ingredient_image_url == '' ? 'default.jpg' : $this->ingredient_image_url;
    }


}
