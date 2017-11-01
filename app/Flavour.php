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

    // Relationship with Recipe Model
    public function recipes()
    {
        return $this->hasMany('App\RecipeFlavourMapping');
    }
}
