<?php

namespace App\Http\Controllers;

use App\UserCuisineTypeMapping;
use Illuminate\Http\Request;
use App\CuisineType;
use Auth;

class UserProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function get_cuisines(){
        $data = UserCuisineTypeMapping::where('user_id', '=', Auth::user()->id)
            ->orderBy('rating')
            ->get();

        if(count($data) == 0){
            $cuisines = CuisineType::all();
            $data = UserCuisineTypeMapping::create_user_mappings($cuisines);

        }

        return view('profile.cuisines', array(
            'cuisine_mappings' => $data
        ));

    }

    public function update(Request $request){
        $data = $request['data'];

        if(count($data) > 0){
            foreach($data as $obj){
                $mapping = UserCuisineTypeMapping::where([
                    ['user_id', Auth::user()->id],
                    ['cuisine_type_id', $obj['cuisineId']]
                ])->update(['rating' => $obj['newRanking']]);

            }

            return response()->json(array(
                'message' => 'Preferences successfully updated',
                'class' => 'success'
            ));

        }


        return response()->json(array(
            'message' => 'You did not make any changes. Click and drag your preferences to arrange them',
            'class' => 'danger'
        ));

    }
}
