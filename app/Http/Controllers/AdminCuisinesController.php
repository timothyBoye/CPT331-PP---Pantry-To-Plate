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

class AdminCuisinesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

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

    public function cuisinesPost(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'number_of_recipes',
        );

        $totalData = CuisineType::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $cuisines = CuisineType::offset($start)
                ->leftJoin('recipes', 'recipes.cuisine_type_id', '=', 'cuisine_types.id')
                ->select('cuisine_types.id as id', 'cuisine_types.name as name',
                    DB::raw('COUNT(DISTINCT(recipes.id)) as number_of_recipes'))
                ->limit($limit)
                ->groupBy('cuisine_types.name')
                ->orderBy($order,$dir)
                ->get();
        } else {
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

        echo json_encode($json_data);

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


    public function seedString($id, Request $request)
    {
        $cuisine = CuisineType::find($id);
        $response = "\App\CuisineType::create(array(";
        $response = $response."'name' => '$cuisine->name'";
        $response = $response."));";

        return response()->json($response, 200);
    }
}
