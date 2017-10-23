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

/**
 * Class AdminMeasurementsController
 *
 * Provides both view display and CRUD functionality for measurement types
 *
 * @package App\Http\Controllers
 */
class AdminMeasurementsController extends Controller
{
    /**
     * AdminMeasurementsController constructor.
     * This method ensures the user is both logged in AND an admin user otherwise the auth middleware will redirect them away
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }


    /**
     * This function displays the measurements table view for the admin dashboard which is a table of all ingredients in the DB with
     * add/edit/delete buttons.
     *
     * Note: this function does not pass measurements data to the view instead this is handled by a separate AJAX post method to allow
     * for pagination, searching and sorting.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * This function handles post requests from the measurements table view to populate and sort the table.
     *
     * @param Request $request
     */
    public function measurementsPost(Request $request)
    {
        // Sortable columns
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'comparable_size',
        );

        // Get how many items there are in the collection to return to the client for displaying
        $totalData = MeasurementType::count();
        $totalFiltered = $totalData;

        // Table parameters for filtering and sorting received from the client request
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        // retrieve all data if no search terms were provided
        if(empty($request->input('search.value'))) {
            $measures = MeasurementType::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        // otherwise filter the collection based on the search terms
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

        // if results were found above to display, render the row for the table for each result.
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

        // Return the data to the view to be displayed in the table
        echo json_encode($json_data);
    }

    /**
     * This function accepts an id value and displays the matching measurement in the measurement form for both
     * viewing and editing.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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

    /**
     * This function provides a blank measurement form for entering a new measurement.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addMeasurement(Request $request)
    {
        $title = 'Add Measurement';
        return view('admin.admin-measurements-form', compact('title'));
    }

    /**
     * When a new measurement is posted by the client this function saves that measurement to the database and redirects
     * the client back to the measurement table with a success message.
     *
     * Note: as we are using a custom request object AdminMeasurementFormRequest we can assume here the measurement is valid
     * as the request object has already validated it.
     *
     * @param AdminMeasurementFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postMeasurement(AdminMeasurementFormRequest $request)
    {
        $measurement = MeasurementType::create($request->all());
        $measurement->save();

        return redirect()->route('admin.measurements')->with(['measurement' => $measurement]);
    }

    /**
     * When the client returns updated values for a Measurement type via a put call this method updates the database and
     * returns the user to the Measurement types table with a success message.
     *
     * Note: as we are using a custom request object AdminMeasurementFormRequest we can assume here the Measurement type is valid
     * as the request object has already validated it.
     *
     * @param $id
     * @param AdminMeasurementFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putMeasurement($id, AdminMeasurementFormRequest $request)
    {
        $measurement = MeasurementType::find($id);
        $measurement->update($request->all());
        $measurement->save();

        return redirect()->route('admin.measurements')->with(['measurement' => $measurement]);
    }

    /**
     * When a delete request is received from the client this message looks for the id in the database, deletes the row
     * and then returns the user to the measurement types table view.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * This method is used by the development team to convert a database entry into a string that can be pasted into the seed
     * database files such that when php artisan db:seed is called this new entry is seeded to the database and not lost.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
