<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class YummlyApiController extends Controller
{

    public function getResults(Request $request)
    {
        // test passing the constructed url as "api" query string
        $api = $request->input('api');

        // we cant pass the api because it is a query string with query strings???

        $json = json_decode(file_get_contents('http://api.yummly.com/v1/api/recipes?_app_id=3f7a00b4&_app_key=552f071f149a489995d4c5c258c23179&q=&allowedIngredient[]=garlic&allowedIngredient[]=cognac'), true);
        return view('result')->with('json', $json);
    }
}
