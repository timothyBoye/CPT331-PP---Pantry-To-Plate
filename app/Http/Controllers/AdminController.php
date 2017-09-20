<?php

namespace App\Http\Controllers;

use App\CuisineType;
use App\Ingredient;
use App\MeasurementType;
use App\Recipe;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $recipes = Recipe::count();
        $ingredients = Ingredient::count();
        $cuisines = CuisineType::count();
        $measurements = MeasurementType::count();
        $users = User::count();


        return view('admin', compact('recipes', 'ingredients',
            'cuisines', 'measurements', 'users'));
    }
}
