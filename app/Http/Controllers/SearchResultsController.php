<?php

namespace App\Http\Controllers;
use App\Ingredient;
use Illuminate\Http\Request;

/**
 * Class SearchResultsController
 *
 * Provides search functionality for the ingredients list
 *
 * @package App\Http\Controllers
 */
class SearchResultsController extends Controller
{
    /**
     * Recieves a string from the user that is the name of an ingredient, tries to find it in the database and returns
     * data about the ingredient if one is found.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSearchResults(Request $request) {
        $searchInput = strtolower($request['ingredient']);
        $match = Ingredient::where(strtolower('name'), '=', $searchInput)->first();
        if($match !== null) {
            return response()->json([
                'id' => $match->id,
                'name' => $match->name,
                'ingredient-url' => $match->ingredient_image_url
            ]);
        }
    }
}

