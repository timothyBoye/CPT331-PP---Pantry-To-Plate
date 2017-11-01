<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * Class User
 *
 * Stores users' data
 *
 * @package App\
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'date_of_birth', 'user_role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // Relationship to RecipeUserMapping Model
    public function savedRecipes()
    {
        return $this->hasMany('App\RecipeUserMapping');
    }
    // Relationship to UserRole Model
    public function role()
    {
        return $this->belongsTo('App\UserRole', 'user_role_id', 'id');
    }
    // Relationship to UserRecipeRating Model
    public function ratings()
    {
        return $this->hasMany('App\UserRecipeRating');
    }

}
