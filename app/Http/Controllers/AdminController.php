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

    public function getCuisine($id, Request $request)
    {
        $cuisine = CuisineType::find($id);
        $title = 'Edit Cuisine Type';
        if ($cuisine) {
            return view('admin.admin-cuisines-form', compact('cuisine','title'));
        } else {
            return redirect()->route('admin.measurements');
        }
    }

    public function addCuisine(Request $request)
    {
        $title = 'Add Cuisine';
        return view('admin.admin-cuisines-form', compact('title'));
    }

    public function setCuisine(Request $request)
    {

    }

    public function deleteCuisine($id, Request $request)
    {
        $cuisine = CuisineType::find($id);
        if ($cuisine) {
            $cuisine->delete();
            return redirect()->route('admin.cuisines');
        } else {
            return redirect()->route('admin.cuisines');
        }
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

    public function getIngredient($id, Request $request)
    {
        $ingredient = Ingredient::find($id);
        $title = 'Edit Ingredient';
        if ($ingredient) {
            return view('admin.admin-ingredients-form', compact('ingredient','title'));
        } else {
            return redirect()->route('admin.measurements');
        }
    }

    public function addIngredient(Request $request)
    {
        $title = 'Add Ingredient';
        return view('admin.admin-ingredients-form', compact('title'));
    }

    public function setIngredient(Request $request)
    {

    }

    public function deleteIngredient($id, Request $request)
    {
        $ingredient = Ingredient::find($id);
        if ($ingredient) {
            $ingredient->delete();
            return redirect()->route('admin.ingredients');
        } else {
            return redirect()->route('admin.ingredients');
        }
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

    public function getMeasurement($id, Request $request)
    {
        $measurement = MeasurementType::find($id);
        $title = 'Edit Measurement Type';
        if ($measurement) {
            return view('admin.admin-measurements-form', compact('measurement','title'));
        } else {
            return redirect()->route('admin.measurements');
        }
    }

    public function addMeasurement(Request $request)
    {
        $title = 'Add Measurement';
        return view('admin.admin-measurements-form', compact('title'));
    }

    public function setMeasurement(Request $request)
    {

    }

    public function deleteMeasurement($id, Request $request)
    {
        $measurement = MeasurementType::find($id);
        if ($measurement) {
            $measurement->delete();
            return redirect()->route('admin.measurements');
        } else {
            return redirect()->route('admin.measurements');
        }
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

    public function addRecipe(Request $request)
    {
        $title = 'Add Recipe';
        return view('admin.admin-recipes-form', compact('title'));
    }

    public function setRecipe(Request $request)
    {

    }

    public function deleteRecipe($id, Request $request)
    {
        $recipe = Recipe::find($id);
        if ($recipe) {
            $recipe->delete();
            return redirect()->route('admin.recipes');
        } else {
            return redirect()->route('admin.recipes');
        }
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

    public function getUser($id, Request $request)
    {
        $user = User::find($id);
        $title = 'Edit User';
        if ($user) {
            return view('admin.admin-users-form', compact('user','title'));
        } else {
            return redirect()->route('admin.users');
        }
    }

    public function addUser(Request $request)
    {
        $title = 'Add User';
        return view('admin.admin-users-form', compact('title'));
    }

    public function setUser(Request $request)
    {

    }

    public function deleteUser($id, Request $request)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.users');
        } else {
            return redirect()->route('admin.users');
        }
    }
}
