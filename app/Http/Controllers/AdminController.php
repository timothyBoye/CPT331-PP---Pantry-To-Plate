<?php

namespace App\Http\Controllers;

use App\CuisineType;
use App\Ingredient;
use App\IngredientCategory;
use App\MeasurementType;
use App\Recipe;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $recipes = Recipe::count();
        $ingredients = Ingredient::count();
        $cuisines = CuisineType::count();
        $measurements = MeasurementType::count();
        $users = User::count();
        $title = "Dashboard";

        return view('admin.admin', compact('recipes', 'ingredients',
            'cuisines', 'measurements', 'users', 'title'));
    }

}
