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

    /**
     * Returns the users saved recipe mappings
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function savedRecipes()
    {
        return $this->hasMany('App\RecipeUserMapping');
    }

    /**
     * Returns the user role type of the user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\UserRole', 'user_role_id', 'id');
    }

    /**
     * Returns the recipe ratings the user has submitted.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany('App\UserRecipeRating');
    }

}
