<?php

namespace App\Http\Controllers;

use App\CuisineType;
use App\Ingredient;
use App\IngredientCategory;
use App\MeasurementType;
use App\Recipe;
use App\User;
use App\UserRole;
use App\Utilities;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminIngredientFormRequest;

class AdminIngredientsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }



    public function ingredients(Request $request)
    {
        $title = "Ingredients";
        $ingredients = Ingredient::all();
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

    public function postIngredient(AdminIngredientFormRequest $request)
    {
        $ingredient = Ingredient::create($request->all());
        $ingredient->save();

        if( $request->hasFile('ingredient_image')) {
            $imageName = Utilities::stripBadFileCharacters($ingredient->name) . '.' .
                $request->file('ingredient_image')->getClientOriginalExtension();
            $file = $request->file('ingredient_image');
            $file->move(base_path() . '/public/img/ingredients/', $imageName);

            $ingredient->update(array('ingredient_image_url'=>$imageName));
            $ingredient->save();
        }

        return redirect()->route('admin.ingredients')->with(['ingredient' => $ingredient]);
    }

    public function putIngredient($id, AdminIngredientFormRequest $request)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->update($request->all());
        $ingredient->save();

        if( $request->hasFile('ingredient_image')) {
            $imageName = Utilities::stripBadFileCharacters($ingredient->name) . '.' .
                $request->file('ingredient_image')->getClientOriginalExtension();
            $file = $request->file('ingredient_image');
            $file->move(base_path() . '/public/img/ingredients/', $imageName);

            $ingredient->update(array('ingredient_image_url'=>$imageName));
            $ingredient->save();
        }
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


    public function seedString($id, Request $request)
    {
        $ingredient = Ingredient::find($id);
        $response = "\App\Ingredient::create(array(";
        $response = $response."'name' => '$ingredient->name', ";
        $response = $response."'ingredient_image_url' => '$ingredient->ingredient_image_url', ";
        $category = IngredientCategory::where('id', '=', $ingredient->ingredient_category_id)->value('name');
        $response = $response."'ingredient_category_id' => IngredientCategory::where('name', '=', '".$category."')->value('id')";
        $response = $response."));";

        return response()->json($response, 200);
    }

}
