<?php

namespace App\Http\Controllers;

use App\UserCuisineTypeMapping;
use Illuminate\Http\Request;
use App\CuisineType;
use Auth;

/**
 * Class UserProfileController
 *
 * Provides access to the user's preferred cuisines functionality
 *
 * @package App\Http\Controllers
 */
class UserProfileController extends Controller
{
    /**
     * UserProfileController constructor.
     * This method ensures the user is logged in otherwise the auth middleware will redirect them away
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Displays the user cuisine preferences page with their current preferences.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_cuisines(){
        $data = UserCuisineTypeMapping::where('user_id', '=', Auth::user()->id)
            ->orderBy('rating')
            ->get();

        $cuisines = CuisineType::all();

        if(count($data) != count($cuisines)) {
            $data = UserCuisineTypeMapping::create_user_mappings($cuisines);
        }

        return view('profile.cuisines', array(
            'cuisine_mappings' => $data
        ));
    }

    /**
     * Accepts a new list of preferences from the user and saves those cuisine preferences to the database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){
        $data = $request['data'];

        // Check that new preferences were received
        if(count($data) > 0) {
            // save the preferences
            foreach($data as $obj) {
                $mapping = UserCuisineTypeMapping::where([
                    ['user_id', Auth::user()->id],
                    ['cuisine_type_id', $obj['cuisineId']]
                ])->update(['rating' => $obj['newRanking']]);
            }

            // return success
            return response()->json(array(
                'message' => 'Preferences successfully updated',
                'class' => 'success'
            ));
        }

        // Let the user know they either didn't change anything or something went wrong.
        return response()->json(array(
            'message' => 'You did not make any changes. Click and drag your preferences to arrange them',
            'class' => 'danger'
        ));

    }
}
