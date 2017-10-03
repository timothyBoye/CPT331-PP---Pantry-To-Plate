<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Recipe extends Model
{
    protected $fillable = [
        'id', 'name', 'short_description', 'long_description', 'method', 'serving_size', 'cuisine_type_id', 'image_url'
    ];

    public function ingredients()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }

    public function cuisine_type()
    {
        return $this->belongsTo('App\CuisineType');
    }

    public function ratings()
    {
        return $this->hasMany('App\UserRecipeRating');
    }

    public function nutritional_info_panel()
    {
        return $this->hasOne('App\NutritionalInfoPanel');
    }

    public function method_steps()
    {
        return explode(Config::get('constants.recipe_method_delimiter'), $this->method);
    }
}
