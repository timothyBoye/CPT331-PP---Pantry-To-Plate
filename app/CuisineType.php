<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuisineType extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function recipes()
    {
        return $this->hasMany('App\Recipe', 'cuisine_type_id', 'id');
    }
}
