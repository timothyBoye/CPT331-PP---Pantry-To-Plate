<?php

namespace App\Http\Controllers;
use App\Ingredient;
use Illuminate\Http\Request;

class SearchResultsController extends Controller
{
    public function getSearchResults(Request $request) {
        $searchInput = $request['ingredient'];
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

