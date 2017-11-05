<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RecipeFlavourMapping
 *
 * Maps values between the Flavour and Recipe tables
 *
 * @package App\
 */
class RecipeFlavourMapping extends Model
{
    // Columns
    protected $fillable = [
        'recipe_id', 'flavour_id', 'flavour_intensity'
    ];

    /**
     * Returns the recipe that this mapping belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }

    /**
     * Returns the flavour that this mapping belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flavour()
    {
        return $this->belongsTo('App\Flavour', 'flavour_id', 'id');
    }
}
