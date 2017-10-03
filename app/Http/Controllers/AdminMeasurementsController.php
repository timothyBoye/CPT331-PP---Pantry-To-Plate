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

class AdminMeasurementsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }



    public function measurements(Request $request)
    {
        $title = "Measurements";
        $measurements = MeasurementType::paginate(10);
        if (session('measurement')) {
            $measurement = session('measurement');
            return view('admin.admin-measurements', compact('title', 'measurements', 'measurement'));
        } else {
            return view('admin.admin-measurements', compact('title', 'measurements'));
        }
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

    public function postMeasurement(Request $request)
    {
        $measurement = MeasurementType::create($request->all());
        $measurement->save();

        return redirect()->route('admin.measurements')->with(['measurement' => $measurement]);
    }

    public function putMeasurement($id, Request $request)
    {
        $measurement = MeasurementType::find($id);
        $measurement->update($request->all());
        $measurement->save();

        return redirect()->route('admin.measurements')->with(['measurement' => $measurement]);
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

}
