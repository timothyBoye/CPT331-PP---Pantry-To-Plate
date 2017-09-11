<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model
{
    public function ingredients()
    {
        return $this->hasMany('App\Ingredient');
    }

}
