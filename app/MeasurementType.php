<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasurementType extends Model
{
    protected $fillable = [
        'name', 'comparable_size'
    ];

    public function ingredients()
    {
        return $this->hasMany('App\IngredientRecipeMapping');
    }
}
