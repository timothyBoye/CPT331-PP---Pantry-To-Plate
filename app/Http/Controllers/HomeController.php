<?php

namespace App\Http\Controllers;

use App\IngredientCategory;
use App\CuisineType;
use App\IngredientRecipeMapping;


class HomeController extends Controller
{

    public function index()
    {
        $categories = IngredientCategory::all();
        $cuisine_types = CuisineType::all();
        //dd($categories, $cuisine_types);
        //return view('home', array('categories' => $categories));//, 'cuisine' => $cuisine_types), array('cuisine' => $cuisine_types));
        return view('home', ['categories' => $categories, 'cuisine' => $cuisine_types]);
    }

}
