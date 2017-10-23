<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RecipeUserMapping;
use Auth;

/**
 * Class SavedRecipesController
 *
 * Provides view display and CRUD functionality for the user saved recipes feature.
 *
 * @package App\Http\Controllers
 */
class SavedRecipesController extends Controller
{
    /**
     * UserProfileController constructor.
     * This method ensures the user is logged in otherwise the auth middleware will redirect them away
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Receives a recipe id from the user and if it hasn't already been saved by the user is saved to the database for
     * them then return success/failure information to the view.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $recipe_id = $request['recipeId'];
        $user_id = Auth::User()->id;

        $mapping_exists = RecipeUserMapping::has_saved_recipe($recipe_id);
        $created_mapping_id = null;

        if (!$mapping_exists){
            $mapping = RecipeUserMapping::create(array(
                'recipe_id' => $recipe_id,
                'user_id' => $user_id
            ));
            $created_mapping_id = $mapping->id;

        }

        return response() -> json([
            'mapping_exists' => $mapping_exists,
            'created_mapping_id' => $created_mapping_id,
            'saved_recipe_id' => $mapping_exists ? null : $recipe_id
        ]);
    }

    /**
     * Displays the user saved recipes view with a list of all the recipes the user has saved.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get()
    {
        $user_id = Auth::User()->id;
        $mappings = RecipeUserMapping::where('user_id', '=', $user_id)->get();

        return view('profile.saved-recipes', array(
            'mappings' => $mappings
        ));
    }

    /**
     * Receives a recipe id from the user and if that recipe id has been saved previously by the user the save is deleted
     * from the database and a success response is returned.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $recipe_id = $request['recipeId'];
        $user_id = Auth::User()->id;
        $mapping = RecipeUserMapping::where(['user_id' => $user_id, 'recipe_id' => $recipe_id])->first();
        $mapping->delete();

        return response()->json([
            'success' => true
        ]);
    }
}