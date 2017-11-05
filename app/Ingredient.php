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

    /**
     * Returns the ingredient category this ingredient belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\IngredientCategory', 'ingredient_category_id', 'id');
    }

    /**
     * Returns all Ingredient Recipe Mapping objects that are of this ingredient type to link this ingredient to all related recipes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipes()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }

    /**
     * Returns the image name for this ingredient, if no image name is defined returns a default image name.
     * @return mixed|string
     */
    public function image_name()
    {
        return $this->ingredient_image_url == '' ? 'default.jpg' : $this->ingredient_image_url;
    }


}
