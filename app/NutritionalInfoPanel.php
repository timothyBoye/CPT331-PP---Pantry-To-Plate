<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NutritionalInfoPanel extends Model
{
    protected $fillable = [
        'id', 'calories', 'gram_total_fat', 'gram_saturated_fat', 'gram_fiber', 'gram_total_carbohydrates', 'gram_sugars',
        'gram_protein', 'mg_sodium', 'recipe_id'
    ];

    public function recipe()
    {
        $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
}
