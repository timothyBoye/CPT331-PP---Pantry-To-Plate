<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CuisineType
 *
 * Stores information regarding recipe cuisine types
 *
 * @package App\
 */

class CuisineType extends Model
{
    public $timestamps = false;

    // Columns
    protected $fillable = [
        'name'
    ];

    /**
     * Returns all recipes that are of this cuisine type.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipes()
    {
        return $this->hasMany('App\Recipe', 'cuisine_type_id', 'id');
    }
}
