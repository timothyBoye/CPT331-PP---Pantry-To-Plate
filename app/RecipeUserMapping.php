<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeUserMapping extends Model
{
    protected $fillable = [
        'recipe_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
}
