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

/**
 * Class AdminController
 *
 * Provides functionality for displaying the admin dashboard for pantry to plate
 *
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * AdminController constructor.
     * This method ensures the user is both logged in AND an admin user otherwise the auth middleware will redirect them away
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Displays the administration panel's dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // These counts are used by the big section links to show how many items are in the database at a glance
        $recipes = Recipe::count();
        $ingredients = Ingredient::count();
        $cuisines = CuisineType::count();
        $measurements = MeasurementType::count();
        $users = User::count();
        // Used by the view to uniformly name the page
        $title = "Dashboard";

        return view('admin.admin', compact('recipes', 'ingredients',
            'cuisines', 'measurements', 'users', 'title'));
    }

}
