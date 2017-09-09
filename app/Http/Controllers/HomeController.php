<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('home', array('ingredients' => $ingredients));
    }
}
