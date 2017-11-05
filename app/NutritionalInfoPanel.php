<?php
/*
 *  Author: Pantry to Plate team Oct 2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NutritionalInfoPanel
 *
 * Stores the nutritional information for a specified recipe
 *
 * @package App\
 */

class NutritionalInfoPanel extends Model
{
    // Columns
    protected $fillable = [
        'id', 'calories', 'gram_total_fat', 'gram_saturated_fat', 'gram_fiber', 'gram_total_carbohydrates', 'gram_sugars',
        'gram_protein', 'mg_sodium', 'recipe_id'
    ];

    /**
     * Returns the recipe that this nutritional panel belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
}
