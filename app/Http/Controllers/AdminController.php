<?php

namespace App\Http\Controllers;

use App\CuisineType;
use App\Ingredient;
use App\MeasurementType;
use App\Recipe;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $recipes = Recipe::count();
        $ingredients = Ingredient::count();
        $cuisines = CuisineType::count();
        $measurements = MeasurementType::count();
        $users = User::count();
        $title = "Dashboard";

        return view('admin', compact('recipes', 'ingredients',
            'cuisines', 'measurements', 'users', 'title'));
    }

    public function cuisines(Request $request)
    {
        $title = "Cuisines";
        $cuisines = CuisineType::paginate(10);

        return view('admin-cuisines', compact('title', 'cuisines'));
    }

    public function ingredients(Request $request)
    {
        $title = "Ingredients";
        $ingredients = Ingredient::paginate(10);

        return view('admin-ingredients', compact('title', 'ingredients'));
    }

    public function measurements(Request $request)
    {
        $title = "Measurements";
        $measurements = MeasurementType::paginate(10);

        return view('admin-measurments', compact('title', 'measurements'));
    }

    public function recipes(Request $request)
    {
        $title = "Recipes";
        $recipes = Recipe::paginate(10);

        return view('admin-recipes', compact('title', 'recipes'));
    }

    public function users(Request $request)
    {
        $title = "Users";
        $users = User::paginate(10);

        return view('admin-users', compact('title', 'users'));
    }
}
