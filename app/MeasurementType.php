<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MeasurementType
 *
 * Stores the different measurement types that are used to specify ingredient quantities
 *
 * @package App\
 */
class MeasurementType extends Model
{
    // Columns
    protected $fillable = [
        'name', 'comparable_size'
    ];

    // Relationship with Ingredient Model
    public function ingredients()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }
}
