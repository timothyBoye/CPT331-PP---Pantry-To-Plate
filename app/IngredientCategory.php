<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IngredientCategory
 *
 * Stores ingredient category names
 *
 * @package App\
 */
class IngredientCategory extends Model
{
    // Columns
    protected $fillable = [
        'name'
    ];

    // Relationship with Ingredient Model
    public function ingredients()
    {
        return $this->hasMany('App\Ingredient')->orderBy('name');
    }

    // Retrieves ingredients grouped according to their category
    public function recipeIngredients()
    {
        return $this->ingredients()
            ->join('ingredient_recipe_mappings', 'id', '=', 'ingredient_id')
            ->groupBy('id');
    }


}
