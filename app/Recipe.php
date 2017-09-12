<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function recipe(){
        return $this->hasMany('App\Ingredient');
    }
}
