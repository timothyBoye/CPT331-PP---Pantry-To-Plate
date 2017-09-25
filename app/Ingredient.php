<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name', 'ingredient_category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\IngredientCategory', 'ingredient_category_id', 'id');
    }

    public function recipes()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }
}
