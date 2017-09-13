<?php

namespace App\Http\Controllers;

use App\IngredientCategory;

class HomeController extends Controller
{

    public function index()
    {
        $categories = IngredientCategory::all();
        return view('home', array('categories' => $categories));
    }
}
