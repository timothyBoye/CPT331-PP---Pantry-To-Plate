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
use App\Http\Requests\AdminMeasurementFormRequest;

class AdminMeasurementsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }



    public function measurements(Request $request)
    {
        $title = "Measurements";
        if (session('measurement')) {
            $measurement = session('measurement');
            return view('admin.admin-measurements', compact('title', 'measurement'));
        } else {
            return view('admin.admin-measurements', compact('title'));
        }
    }


    public function measurementsPost(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'comparable_size',
        );

        $totalData = MeasurementType::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $measures = MeasurementType::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $measures =  MeasurementType::offset($start)
                ->limit($limit)
                ->where('measurement_types.id','LIKE',"%{$search}%")
                ->orWhere('measurement_types.name', 'LIKE',"%{$search}%")
                ->orWhere('measurement_types.comparable_size', 'LIKE',"%{$search}%")
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = count($measures);
        }

        $data = array();
        if(!empty($measures))
        {
            foreach ($measures as $measure)
            {
                $csrf_field = csrf_field();

                $nestedData['id'] = $measure->id;
                $nestedData['name'] = $measure->name;
                $nestedData['comparable_size'] = $measure->comparable_size;
                // edit button
                $edit = route('admin.measurement.get', ['id' => $measure->id]);
                $nestedData['edit'] = <<<EDIT
                    <form class="admin-table-buttons" action="{$edit}" method="GET">
                        {$csrf_field}
                        <button class="btn btn-info btn-sm" type="submit">Edit</button>
                    </form>
EDIT;

                // seed button
                $seed = route('admin.measurement.seeder', ['id' => $measure->id]);
                $nestedData['seed'] = <<<SEED
                    <form id="seed_form_{$measure->id}" class="admin-table-buttons" action="" method="POST">
                        {$csrf_field}
                        <button id="seed_button_{$measure->id}" data-api-controller-url="{$seed}" class="btn btn-default btn-sm" type="button">Seed String</button>
                        <script>
                            $('#seed_button_{$measure->id}').click(function(){
                                console.log('click');
                                $.ajax({
                                    url: $('#seed_button_{$measure->id}').attr('data-api-controller-url'),
                                    type: 'POST',
                                    data: $('#seed_form_{$measure->id}').serialize()
                                }).done(function(response){
                                    $('#seed_string').html('<pre>'+response+'</pre>');
                                }).fail(function(response){
                                    $('#seed_string').html(response.responseText);
                                });
                            });
                        </script>
                    </form>
SEED;

                // delete button
                $delete = route('admin.measurement.delete', ['id' => $measure->id]);
                $delete_filed = method_field('DELETE');
                $nestedData['delete'] = <<<DELETE
                    <form class="admin-table-buttons" action="{$delete}" method="POST">
                        {$delete_filed}
                        {$csrf_field}
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
DELETE;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
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

    public function postMeasurement(AdminMeasurementFormRequest $request)
    {
        $measurement = MeasurementType::create($request->all());
        $measurement->save();

        return redirect()->route('admin.measurements')->with(['measurement' => $measurement]);
    }

    public function putMeasurement($id, AdminMeasurementFormRequest $request)
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


    public function seedString($id, Request $request)
    {
        $measure = MeasurementType::find($id);
        $response = "\App\MeasurementType::create(array(";
        $response = $response."'name' => '$measure->name', ";
        $response = $response."'comparable_size' => '$measure->comparable_size'";
        $response = $response."));";

        return response()->json($response, 200);
    }
}
