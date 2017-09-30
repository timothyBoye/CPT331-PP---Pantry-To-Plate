<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name', 'ingredient_category_id', 'ingredient_image_url'
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
