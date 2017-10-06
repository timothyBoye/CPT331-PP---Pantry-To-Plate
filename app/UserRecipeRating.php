<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserRecipeRating extends Model
{

    protected $fillable = [
        'recipe_id', 'user_id', 'rating'
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }

    public static function get_ratings_for_user($recipes){
        $userRatings = [];
        foreach($recipes as $recipe) {
            if (Auth::check()) {
                $userRating = UserRecipeRating::where('recipe_id', '=', $recipe->id)
                    ->where('user_id', '=', Auth::id())
                    ->first();
                if ($userRating) {
                    array_push($userRatings, $userRating);
                }
            }
        }
        return $userRatings;
    }

}
