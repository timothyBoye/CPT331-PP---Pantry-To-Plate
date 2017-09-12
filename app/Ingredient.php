<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function category(){
        return $this->belongsTo('App\IngredientCategory');
    }

    public function recipe(){
        return $this->belongsTo('App\Recipe');
    }

    public function ingredientAmount(){
        return $this->hasMany('App\MeasurementType');
    }
}
