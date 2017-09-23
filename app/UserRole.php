<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_role_name'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
