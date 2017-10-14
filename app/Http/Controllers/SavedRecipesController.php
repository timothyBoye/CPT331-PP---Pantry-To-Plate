<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RecipeUserMapping;
use Auth;

class SavedRecipesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

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

    public function get(){
        $user_id = Auth::User()->id;
        $mappings = RecipeUserMapping::where('user_id', '=', $user_id)->get();

        return view('profile.saved-recipes', array(
            'mappings' => $mappings
        ));
    }
    public function delete(Request $request){
        $recipe_id = $request['recipeId'];
        $user_id = Auth::User()->id;
        $mapping = RecipeUserMapping::where(['user_id' => $user_id, 'recipe_id' => $recipe_id])->first();
        $mapping->delete();

        return response()->json([
            'success' => true
        ]);

    }
}