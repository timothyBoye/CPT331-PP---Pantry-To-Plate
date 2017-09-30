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


    /*
     * CUISINES
     */

    public function cuisines(Request $request)
    {
        $title = "Cuisines";
        $cuisines = CuisineType::paginate(10);

        return view('admin.admin-cuisines', compact('title', 'cuisines'));
    }

    public function getCuisine(Request $request)
    {

    }

    public function setCuisine(Request $request)
    {

    }

    public function cuisineForm(Request $request)
    {

    }


    /*
     * INGREDIENTS
     */

    public function ingredients(Request $request)
    {
        $title = "Ingredients";
        $ingredients = Ingredient::paginate(10);

        return view('admin.admin-ingredients', compact('title', 'ingredients'));
    }

    public function getIngredient(Request $request)
    {

    }

    public function setIngredient(Request $request)
    {

    }

    public function ingredientForm(Request $request)
    {

    }


    /*
     * MEASUREMENTS
     */

    public function measurements(Request $request)
    {
        $title = "Measurements";
        $measurements = MeasurementType::paginate(10);

        return view('admin.admin-measurements', compact('title', 'measurements'));
    }

    public function getMeasurement(Request $request)
    {

    }

    public function setMeasurement(Request $request)
    {

    }

    public function measurementForm(Request $request)
    {

    }


    /*
     * RECIPES
     */

    public function recipes(Request $request)
    {
        $title = "Recipes";
        $recipes = Recipe::paginate(10);

        return view('admin.admin-recipes', compact('title', 'recipes'));
    }

    public function getRecipe($id, Request $request)
    {
        $recipe = Recipe::find($id);
        $title = 'Edit Recipe';
        if ($recipe) {
            return view('admin.admin-recipes-form', compact('recipe','title'));
        } else {
            return redirect()->route('admin.recipes');
        }
    }

    public function setRecipe(Request $request)
    {

    }

    public function addRecipe(Request $request)
    {
        $title = 'Add Recipe';
        return view('admin.admin-recipes-form', compact('title'));
    }

    /*
     * USERS
     */

    public function users(Request $request)
    {
        $title = "Users";
        $users = User::paginate(10);

        return view('admin.admin-users', compact('title', 'users'));
    }

    public function getUser(Request $request)
    {

    }

    public function setUser(Request $request)
    {

    }

    public function userForm(Request $request)
    {

    }
}
