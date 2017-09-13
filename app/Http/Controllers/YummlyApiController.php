<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
class YummlyApiController extends Controller
{

    //public $maxResultsPerPage = 10;
    //public $pageIndex = 1;

    public function getResults(Request $request)
    {
        // test passing the constructed url as "api" query string
        //$pageIndex = (int)$request['page'];
        //$pageIndex = $request->input('page');
        //$startOffset = $pageIndex * $this->maxResultsPerPage;
        $apiUrl = $request['apiUrl']; //.'&maxResult='.$this->maxResultsPerPage.'&start='.$startOffset;
        $guzClient = new GuzzleHttp\Client(['base_uri' => $apiUrl]);
        $res = $guzClient->request('GET', $apiUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json'
            ]
        ]);

        //$this->pageIndex = $this->pageIndex + 1;

        // Return a json response here so we are returning the data to the caller, because it was an ajax call,
        // if we redirect or return a view, the view will change before the ajax call has finished
        return response()->json(['data' => json_decode($res->getBody()->getContents())]);
    }
}
