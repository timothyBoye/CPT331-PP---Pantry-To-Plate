<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pantry extends Model
{
    public function pantry(){
        return $this->hasMany('App\Ingredient');
    }
}
