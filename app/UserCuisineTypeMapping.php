<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserCuisineTypeMapping extends Model
{
    protected $fillable = ['user_id', 'cuisine_type_id', 'rating'];

    public function cuisine_type(){
        return $this->belongsTo('App\CuisineType');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public static function create_user_mappings($cuisines){
        $i = 0;
        foreach($cuisines as $cuisine){
            UserCuisineTypeMapping::create(array(
                'user_id' => Auth::user()->id,
                'cuisine_type_id' => $cuisine->id,
                'rating' => $i++
            ));
        }
        return UserCuisineTypeMapping::where('user_id', '=', Auth::user()->id)->orderBy('rating')->get();
    }
}
