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

class AdminIngredientsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }



    public function ingredients(Request $request)
    {
        $title = "Ingredients";
        $ingredients = Ingredient::paginate(10);
        if (session('ingredient')) {
            $ingredient = session('ingredient');
            return view('admin.admin-ingredients', compact('title', 'ingredients', 'ingredient'));
        } else {
            return view('admin.admin-ingredients', compact('title', 'ingredients'));
        }

    }

    public function getIngredient($id, Request $request)
    {
        $ingredient = Ingredient::find($id);
        $title = 'Edit Ingredient';
        $categories = IngredientCategory::all();
        if ($ingredient) {
            return view('admin.admin-ingredients-form', compact('ingredient','title', 'categories'));
        } else {
            return redirect()->route('admin.measurements');
        }
    }

    public function addIngredient(Request $request)
    {
        $title = 'Add Ingredient';
        $categories = IngredientCategory::all();
        return view('admin.admin-ingredients-form', compact('title', 'categories'));
    }

    public function postIngredient(Request $request)
    {
        $ingredient = Ingredient::create($request->all());
        $ingredient->save();
        return redirect()->route('admin.ingredients')->with(['ingredient' => $ingredient]);
    }

    public function putIngredient($id, Request $request)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->update($request->all());
        $ingredient->save();
        return redirect()->route('admin.ingredients')->with(['ingredient' => $ingredient]);
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


}
