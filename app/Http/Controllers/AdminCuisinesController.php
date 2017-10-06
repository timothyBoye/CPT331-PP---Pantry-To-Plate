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
use App\Http\Requests\AdminCuisinesFormRequest;

class AdminCuisinesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function cuisines(Request $request)
    {
        $title = "Cuisines";
        $cuisines = CuisineType::paginate(10);
        if (session('cuisine')) {
            $cuisine = session('cuisine');
            return view('admin.admin-cuisines', compact('title', 'cuisines', 'cuisine'));
        } else {
            return view('admin.admin-cuisines', compact('title', 'cuisines'));
        }
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

    public function postCuisine(AdminCuisinesFormRequest $request)
    {
        $cuisine = CuisineType::create($request->all());
        $cuisine->save();
        return redirect()->route('admin.cuisines')->with(['cuisine' => $cuisine]);
    }

    public function putCuisine($id, AdminCuisinesFormRequest $request)
    {
        $cuisine = CuisineType::find($id);
        $cuisine->update($request->all());
        $cuisine->save();

        return redirect()->route('admin.cuisines')->with(['cuisine' => $cuisine]);
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


    public function seedString(Request $request)
    {
        $response = "\App\CuisineType::create(array(";
        $response = $response."'name' => '".$request["name"]."'";
        $response = $response."));";

        return response()->json($response, 200);
    }
}
