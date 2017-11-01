<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

/**
 * Class UserRecipeRating
 *
 * Stores users' recipe ratings
 *
 * @package App\
 */
class UserRecipeRating extends Model
{
    // Columns
    protected $fillable = [
        'recipe_id', 'user_id', 'rating'
    ];
    // Relationship with User Model
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    // Relationship with Recipe Model
    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
    // Returns an array of ratings by a specified user for a given array of recipes
    public static function get_ratings_for_user($recipes)
    {
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
