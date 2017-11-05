<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Flavour
 *
 * Stores information regarding recipe flavours
 *
 * @package App\
 */

class Flavour extends Model
{
    public $timestamps = false;

    // Columns
    protected $fillable = [
        'name'
    ];

    /**
     * Returns all RecipeFlavourMappings that are of this flavour type to link this flavour type to related recipes.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipes()
    {
        return $this->hasMany('App\RecipeFlavourMapping');
    }
}
