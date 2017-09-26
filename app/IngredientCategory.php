<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model
{
    protected $fillable = [
        'name'
    ];

    public function ingredients()
    {
        return $this->hasMany('App\Ingredient');
    }

    public function recipeIngredients()
    {
        return $this->ingredients()
            ->join('ingredient_recipe_mappings', 'id', '=', 'ingredient_id')
            ->groupBy('id');
    }

}
