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

    /**
     * Returns the user that saved this recipe mapping
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Returns the saved recipe
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'recipe_id', 'id');
    }

    /**
     * Checks whether a user has saved a given recipe
     * @param $recipe_id
     * @return mixed
     */
    public static function has_saved_recipe($recipe_id)
    {
        $user_id = Auth::User() ->id;
        return RecipeUserMapping::where(['recipe_id' => $recipe_id, 'user_id' => $user_id])->exists();
    }
}
