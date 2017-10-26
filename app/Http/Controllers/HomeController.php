<?php

namespace App\Http\Controllers;

use App\IngredientCategory;
use App\CuisineType;
use App\IngredientRecipeMapping;

/**
 * Class HomeController
 *
 * Provides both view display functionality for the pantry to plate home page
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * This function displays the main home page of pantry to plate
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = IngredientCategory::all();
        $cuisine_types = CuisineType::all();

        return view('home', ['categories' => $categories, 'cuisine' => $cuisine_types]);
    }

}
