<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'id', 'name', 'short_description', 'long_description', 'method', 'serving_size', 'cuisine_type_id'
    ];

    public function ingredients()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }

    public function cuisine_type()
    {
        return $this->belongsTo('App\CuisineType');
    }
}
