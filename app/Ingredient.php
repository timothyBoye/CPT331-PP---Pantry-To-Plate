<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function category(){
        return $this->belongsTo('App\IngredientCategory');
    }
}
