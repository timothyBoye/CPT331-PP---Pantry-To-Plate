<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
/**
 * Class RecipeUserMapping
 *
 * Stores users' saved recipes
 *
 * @package App\
 */
class RecipeUserMapping extends Model
{
    // Columns
    protected $fillable = [
        'recipe_id', 'user_id'
    ];
    // Relationship to User Model
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    // Relationship to Recipe Model
    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }
    // Checks whether a user has saved a given recipe
    public static function has_saved_recipe($recipe_id)
    {
        $user_id = Auth::User() ->id;
        return RecipeUserMapping::where(['recipe_id' => $recipe_id, 'user_id' => $user_id])->exists();
    }
}
