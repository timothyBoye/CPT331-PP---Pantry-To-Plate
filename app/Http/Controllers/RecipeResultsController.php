<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
class RecipeResultsController extends Controller
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
        // Return a json response here so we are returning the data to the caller, because it was an ajax call,
        // if we redirect or return a view, the view will change before the ajax call has finished
        return response()->json(['yummly_results' => json_decode($res->getBody()->getContents())]);
    }
}
