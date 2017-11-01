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
    // Relationship with User Model
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
