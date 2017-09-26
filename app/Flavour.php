<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flavour extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function recipes()
    {
        return $this->hasMany('App\RecipeFlavourMapping');
    }
}
