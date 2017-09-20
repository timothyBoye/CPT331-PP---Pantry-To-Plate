<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function ingredients()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }

    public function cuisine_type(){
        return $this->belongsTo('App\CuisineType');
    }
}
