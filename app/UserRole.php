<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class UserRole
 *
 * Stores site user types
 *
 * @package App\
 */
class UserRole extends Model
{
    public $timestamps = false;

    // Columns
    protected $fillable = [
        'user_role_name'
    ];

    /**
     * Returns the users that are of this user role type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
