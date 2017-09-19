<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasurementType extends Model
{
    public function ingredients()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }
}
