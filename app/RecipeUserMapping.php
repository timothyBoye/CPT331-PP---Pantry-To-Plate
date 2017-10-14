<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

    public static function has_saved_recipe($recipe_id){
        $user_id = Auth::User() ->id;
        return RecipeUserMapping::where(['recipe_id' => $recipe_id, 'user_id' => $user_id]) ->exists();
    }
}
