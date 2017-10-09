<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeMethod extends Model
{
    protected $fillable = [
        'recipe_id', 'step_number', 'description', 'image_url'
    ];

    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
}
