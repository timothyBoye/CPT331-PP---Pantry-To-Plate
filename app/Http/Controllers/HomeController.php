<?php

namespace App\Http\Controllers;

use App\IngredientCategory;
use Illuminate\Http\Request;
use App\Ingredient;

class HomeController extends Controller
{

    public function index()
    {
        $ingredients = Ingredient::all();
        $categories = IngredientCategory::all();
        return view('home', array('categories' => $categories));
    }
}
