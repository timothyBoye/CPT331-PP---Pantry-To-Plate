<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\Auth;

class RecipeResultsController extends Controller
{
    public function getResults(Request $request)
    {
        $ingredients = $request['ingredients'];

        return response()->json(json_encode($ingredients));
    }
}
