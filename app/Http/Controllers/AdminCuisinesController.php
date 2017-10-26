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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminCuisinesFormRequest;

/**
 * Class AdminCuisinesController
 *
 * Provides both view display and CRUD functionality for cuisine types
 *
 * @package App\Http\Controllers
 */
class AdminCuisinesController extends Controller
{
    /**
     * AdminCuisinesController constructor.
     * This function ensures the user is both logged in AND an admin user otherwise the auth middleware will redirect them away
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * This function displays the cuisines table view for the admin dashboard which is a table of all cuisines in the DB with
     * add/edit/delete buttons.
     *
     * Note: this function does not pass cuisine data to the view instead this is handled by a seperate AJAX post method to allow
     * for pagination, searching and sorting.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cuisines(Request $request)
    {
        $title = "Cuisines";
        if (session('cuisine')) {
            $cuisine = session('cuisine');
            return view('admin.admin-cuisines', compact('title', 'cuisine'));
        } else {
            return view('admin.admin-cuisines', compact('title'));
        }
    }

    /**
     * This function handles post requests from the cuisines table view to populate and sort the table.
     *
     * @param Request $request
     */
    public function cuisinesPost(Request $request)
    {
        // Sortable columns
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'number_of_recipes',
        );

        // Get how many items there are in the collection to return to the client for displaying
        $totalData = CuisineType::count();
        $totalFiltered = $totalData;

        // Table parameters for filtering and sorting received from the client request
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        // retrieve all data if no search terms were provided
        if(empty($request->input('search.value'))) {
            $cuisines = CuisineType::offset($start)
                ->leftJoin('recipes', 'recipes.cuisine_type_id', '=', 'cuisine_types.id')
                ->select('cuisine_types.id as id', 'cuisine_types.name as name',
                    DB::raw('COUNT(DISTINCT(recipes.id)) as number_of_recipes'))
                ->limit($limit)
                ->groupBy('cuisine_types.name')
                ->orderBy($order,$dir)
                ->get();

        }
        // otherwise filter the collection based on the search terms
        else {
            $search = $request->input('search.value');

            $cuisines = CuisineType::offset($start)
                ->leftJoin('recipes', 'recipes.cuisine_type_id', '=', 'cuisine_types.id')
                ->select('cuisine_types.id as id', 'cuisine_types.name as name',
                    DB::raw('COUNT(DISTINCT(recipes.id)) as number_of_recipes'))
                ->limit($limit)
                ->where('cuisine_types.id','LIKE',"%{$search}%")
                ->orWhere('cuisine_types.name', 'LIKE',"%{$search}%")
                ->groupBy('cuisine_types.name')
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = count($cuisines);
        }

        // if results were found above to display, render the row for the table for each result.
        $data = array();
        if(!empty($cuisines))
        {
            foreach ($cuisines as $cuisine)
            {
                $csrf_field = csrf_field();

                $nestedData['id'] = $cuisine->id;
                $nestedData['name'] = $cuisine->name;
                $nestedData['number_of_recipes'] = $cuisine->number_of_recipes;
                // edit button
                $edit = route('admin.cuisine.get', ['id' => $cuisine->id]);
                $nestedData['edit'] = <<<EDIT
                    <form class="admin-table-buttons" action="{$edit}" method="GET">
                        {$csrf_field}
                        <button class="btn btn-info btn-sm" type="submit">Edit</button>
                    </form>
EDIT;
                // seed button
                $seed = route('admin.cuisine.seeder', ['id' => $cuisine->id]);
                $nestedData['seed'] = <<<SEED
                    <form id="seed_form_{$cuisine->id}" class="admin-table-buttons" action="" method="POST">
                        {$csrf_field}
                        <button id="seed_button_{$cuisine->id}" data-api-controller-url="{$seed}" class="btn btn-default btn-sm" type="button">Seed String</button>
                        <script>
                            $('#seed_button_{$cuisine->id}').click(function(){
                                console.log('click');
                                $.ajax({
                                    url: $('#seed_button_{$cuisine->id}').attr('data-api-controller-url'),
                                    type: 'POST',
                                    data: $('#seed_form_{$cuisine->id}').serialize()
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
                $delete = route('admin.cuisine.delete', ['id' => $cuisine->id]);
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
     * This function accepts an id value and displays the matching cuisine type in the cuisine type form for both
     * viewing and editing.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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

    /**
     * This function provides a blank cuisine type for for entering a new cuisine type.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addCuisine(Request $request)
    {
        $title = 'Add Cuisine';
        return view('admin.admin-cuisines-form', compact('title'));
    }

    /**
     * When a new cuisine type is posted by the client this function saves that cuisine type to the database and redirects
     * the client back to the cuisine table with a success message.
     *
     * Note: as we are using a custom request object AdminCuisinesFormRequest we can assume here the cuisine type is valid
     * as the request object has already validated it.
     *
     * @param AdminCuisinesFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCuisine(AdminCuisinesFormRequest $request)
    {
        $cuisine = CuisineType::create($request->all());
        $cuisine->save();
        return redirect()->route('admin.cuisines')->with(['cuisine' => $cuisine]);
    }

    /**
     * When the client returns updated values for a cuisine type via a put call this method updates the database and
     * returns the user to the cuisine types table with a success message.
     *
     * Note: as we are using a custom request object AdminCuisinesFormRequest we can assume here the cuisine type is valid
     * as the request object has already validated it.
     *
     * @param $id
     * @param AdminCuisinesFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putCuisine($id, AdminCuisinesFormRequest $request)
    {
        $cuisine = CuisineType::find($id);
        $cuisine->update($request->all());
        $cuisine->save();

        return redirect()->route('admin.cuisines')->with(['cuisine' => $cuisine]);
    }

    /**
     * When a delete request is received from the client this message looks for the id in the database, deletes the row
     * and then returns the user to the cuisine types table view.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
        $cuisine = CuisineType::find($id);
        $response = "\App\CuisineType::create(array(";
        $response = $response."'name' => '$cuisine->name'";
        $response = $response."));";

        return response()->json($response, 200);
    }
}
