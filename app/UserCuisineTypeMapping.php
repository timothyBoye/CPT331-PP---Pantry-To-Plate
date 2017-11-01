<?php
/**
 * Author: Pantry to Plate team Sept 2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
/**
 * Class UserCuisineTypeMapping
 *
 * Stores users' cuisine type preference order
 *
 * @package App\
 */
class UserCuisineTypeMapping extends Model
{
    // Columns
    protected $fillable = ['user_id', 'cuisine_type_id', 'rating'];

    // Relationship to CuisineType Model
    public function cuisine_type(){
        return $this->belongsTo('App\CuisineType');
    }
    // Relationship to User Model
    public function user(){
        return $this->belongsTo('App\User');
    }
    // Maps users' cuisine ratings to each cuisine and returns an array sorted by rating
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
