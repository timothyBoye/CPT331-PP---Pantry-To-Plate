<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRecipeRating extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
}
