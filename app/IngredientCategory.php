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

    /**
     * Returns all ingredients that are of this category type
     * @return mixed
     */
    public function ingredients()
    {
        return $this->hasMany('App\Ingredient')->orderBy('name');
    }

    /**
     * Returns all ingredients that are of this category type AND used in at least one recipe.
     * @return mixed
     */
    public function recipeIngredients()
    {
        return $this->ingredients()
            ->join('ingredient_recipe_mappings', 'id', '=', 'ingredient_id')
            ->groupBy('id');
    }


}
