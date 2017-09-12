<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
class YummlyApiController extends Controller
{

    public function getResults(Request $request)
    {
        // test passing the constructed url as "api" query string
        $apiUrl = $request['apiUrl'];
        $guzClient = new GuzzleHttp\Client(['base_uri' => $apiUrl]);
        $res = $guzClient->request('GET', $apiUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json'
            ]
        ]);

        //$json = json_decode(file_get_contents('http://api.yummly.com/v1/api/recipes?_app_id=3f7a00b4&_app_key=552f071f149a489995d4c5c258c23179&q=&allowedIngredient[]=garlic&allowedIngredient[]=cognac'), true);
        return response()->json(['data' => json_decode($res->getBody()->getContents())]);
    }
}
