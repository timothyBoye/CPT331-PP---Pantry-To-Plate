<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientRecipeMapping extends Model
{
    public function recipe(){
        return $this->belongsTo('App\Recipe');
    }

    public function ingredient(){
        return $this->belongsTo('App\Ingredient');
    }
}
