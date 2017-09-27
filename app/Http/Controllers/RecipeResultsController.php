<?php

namespace App\Http\Controllers;

use App\IngredientRecipeMapping;
use App\UserRecipeRating;
use Illuminate\Http\Request;
use App\Ingredient;
use App\Recipe;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> b8eb397aa23f3c0ecd92547d472fbee253fde4c8

class RecipeResultsController extends Controller
{
    public function getResults(Request $request)
    {
        $ingredients = $request['ingredients'];
        $ingredient_ids = [];
        foreach ($ingredients as $ingredient) {
            array_push($ingredient_ids, Ingredient::where('name', $ingredient)->value('id'));
        }
        $recipe_ids = [];
        foreach ($ingredient_ids as $id) {

//            foreach (IngredientRecipeMapping::select('recipe_id')->where('ingredient_id', '=', $id)->get() as $recipe_id) {
                foreach (IngredientRecipeMapping::select('recipe_id')->where('ingredient_id', '=', $id)->get() as $recipe_id) {

                    //print_r($occurrences.",");

                    //if (!in_array($recipe_id->recipe_id, $recipe_ids)) {
                        array_push($recipe_ids, $recipe_id->recipe_id);
                    //}
                }
        }

        //print_r($recipe_ids); // 3,6,6,7
        $occurrences = array_count_values($recipe_ids);
        arsort($occurrences);
        //print_r($occurrences); //6(2),3(1),7(1)

        $sorted_recipe_ids = [];
        foreach($occurrences as $key => $val) {
            array_push($sorted_recipe_ids, $key);
        }
        //print_r($sorted_recipe_ids); //6,3,7

        //$recipes = Recipe::findMany($recipe_ids)->sortByDesc("name");//$sorted_recipe_ids);
        //$test = [2,3,1];
        //$idsImploded = implode(',',$test);
        //$recipes = Recipe::whereIn([3,2,1])->orderByRaw("FIND_IN_SET('id','$idsImploded')")->get();
        //$recipes = Recipe::findMany([2,3,1]);//->orderByRaw("FIND_IN_SET('id','$idsImploded')");
        //$recipes = Recipe::whereKey($test)->orderByRaw(DB::raw("FIELD(id, $idsImploded)"))->get(['*']);

        $recipes = [];
        foreach($sorted_recipe_ids as $recipe_id) {
            $recipe = Recipe::find($recipe_id);
            array_push($recipes, $recipe);
        }
        //print_r($recipes[0]['name']);

        //print_r($occurrences);

        $returnHTML = view('recipe-list', compact('recipes'))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

//        $mappings = [];
//        foreach($ingredients as $ingredient) {
//            $ingredient_id = Ingredient::where('name', $ingredient)->value('id');
//            array_push($mappings, IngredientRecipeMapping::where('ingredient_id', $ingredient_id)->get());
//        }
//
//        $recipes = [];
//        foreach($mappings as $mapping) {
//            foreach($mapping as $mapping_obj) {
//                $recipe = Recipe::where('id', $mapping_obj->recipe_id)->get();
//                if(!in_array($recipe, $recipes)){
//                    array_push($recipes, $recipe);
//                }
//            }
//        }
//        return response()->json(array('recipes' => $recipes));
    }


    public function show($id)
    {
        $recipe = Recipe::find($id);
        if ($recipe) {
            return view('recipe', compact('recipe'));
        } else {
            return redirect()->route('home');
        }
    }

    public function setRating(Request $request)
    {
        $recipe_id = $request['id'];
        $rating = $request['rating'];
        $user_id = Auth::id();
        $userRecipeRating = UserRecipeRating::where('recipe_id', '=', $recipe_id)
            ->where('user_id', '=', $user_id)
            ->first();
        if(!$userRecipeRating) {
            $userRecipeRating = UserRecipeRating::create(
                ['recipe_id' => $recipe_id,
                    'user_id' => $user_id,
                    'rating' => $rating]
            );
        } else {
            $userRecipeRating->rating = $rating;
        }
        $userRecipeRating->save();

        $recipe = Recipe::find($recipe_id);
        $ratings = UserRecipeRating::where('recipe_id', '=', $recipe_id )->get();
        $count = 0;
        $sum = 0;
        foreach ($ratings as $rating) {
            $count++;
            $sum += $rating->rating;
        }
        $recipe->average_rating = $sum/$count;
        $recipe->number_of_ratings = $count;
        $recipe->save();

        return response()->json(array('success' => true, 'html' => $userRecipeRating->user_id));
    }
}
