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
use Illuminate\Support\Facades\DB;
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
        if (session('ingredient')) {
            $ingredient = session('ingredient');
            return view('admin.admin-ingredients', compact('title', 'ingredient'));
        } else {
            return view('admin.admin-ingredients', compact('title'));
        }

    }

    public function ingredientsPost(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'category',
            3 => 'in_recipes'
        );

        $totalData = Ingredient::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $ingredients = Ingredient::offset($start)
                ->leftJoin('ingredient_recipe_mappings', 'ingredient_recipe_mappings.ingredient_id', '=', 'ingredients.id')
                ->leftJoin('ingredient_categories', 'ingredient_categories.id', '=', 'ingredients.ingredient_category_id')
                ->select('ingredients.id as id', 'ingredients.name as name',
                    'ingredient_categories.name as category', DB::raw('COUNT(DISTINCT(ingredient_recipe_mappings.recipe_id)) as in_recipes'))
                ->limit($limit)
                ->groupBy('ingredients.id')
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $ingredients =  Ingredient::offset($start)
                ->leftJoin('ingredient_recipe_mappings', 'ingredient_recipe_mappings.ingredient_id', '=', 'ingredients.id')
                ->leftJoin('ingredient_categories', 'ingredient_categories.id', '=', 'ingredients.ingredient_category_id')
                ->select('ingredients.id as id', 'ingredients.name as name',
                    'ingredient_categories.name as category', DB::raw('COUNT(DISTINCT(ingredient_recipe_mappings.recipe_id)) as in_recipes'))
                ->limit($limit)
                ->groupBy('ingredients.id')
                ->where('ingredients.id','LIKE',"%{$search}%")
                ->orWhere('ingredients.name', 'LIKE',"%{$search}%")
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = count($ingredients);
        }

        $data = array();
        if(!empty($ingredients))
        {
            foreach ($ingredients as $ingredient)
            {
                $csrf_field = csrf_field();

                $nestedData['id'] = $ingredient->id;
                $nestedData['name'] = $ingredient->name;
                $nestedData['category'] = $ingredient->category;
                $nestedData['in_recipes'] = $ingredient->in_recipes;
                // edit button
                $edit = route('admin.ingredient.get', ['id' => $ingredient->id]);
                $nestedData['edit'] = <<<EDIT
                    <form class="admin-table-buttons" action="{$edit}" method="GET">
                        {$csrf_field}
                        <button class="btn btn-info btn-sm" type="submit">Edit</button>
                    </form>
EDIT;

                // seed button
                $seed = route('admin.ingredient.seeder', ['id' => $ingredient->id]);
                $nestedData['seed'] = <<<SEED
                    <form id="seed_form_{$ingredient->id}" class="admin-table-buttons" action="" method="POST">
                        {$csrf_field}
                        <button id="seed_button_{$ingredient->id}" data-api-controller-url="{$seed}" class="btn btn-default btn-sm" type="button">Seed String</button>
                        <script>
                            $('#seed_button_{$ingredient->id}').click(function(){
                                console.log('click');
                                $.ajax({
                                    url: $('#seed_button_{$ingredient->id}').attr('data-api-controller-url'),
                                    type: 'POST',
                                    data: $('#seed_form_{$ingredient->id}').serialize()
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
                $delete = route('admin.ingredient.delete', ['id' => $ingredient->id]);
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
