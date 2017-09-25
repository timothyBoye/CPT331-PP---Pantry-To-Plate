<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeFlavourMapping extends Model
{
    protected $fillable = [
        'recipe_id', 'flavour_id', 'flavour_intensity'
    ];

    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }

    public function flavour()
    {
        return $this->belongsTo('App\Flavour', 'flavour_id', 'id');
    }
}
