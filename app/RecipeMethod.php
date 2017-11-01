<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RecipeMethod
 *
 * Stores information for the steps in a recipe method
 *
 * @package App\
 */

class RecipeMethod extends Model
{
    // Columns
    protected $fillable = [
        'recipe_id', 'step_number', 'description', 'image_url'
    ];
    // Relationship with Recipe Model
    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
}
