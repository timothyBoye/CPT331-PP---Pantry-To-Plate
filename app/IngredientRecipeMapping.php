<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientRecipeMapping extends Model
{
    protected $fillable = [
        'recipe_id'
    ];

    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }

    public function ingredient()
    {
        return $this->belongsTo('App\Ingredient');
    }

    public function measure()
    {
        return $this->belongsTo('App\MeasurementType', 'measurement_type_id', 'id');
    }
}
