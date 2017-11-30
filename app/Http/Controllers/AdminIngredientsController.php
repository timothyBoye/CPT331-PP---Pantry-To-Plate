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

/**
 * Class AdminIngredientsController
 *
 * Provides both view display and CRUD functionality for ingredients
 *
 * @package App\Http\Controllers
 */
class AdminIngredientsController extends Controller
{
    /**
     * AdminIngredientsController constructor.
     * This method ensures the user is both logged in AND an admin user otherwise the auth middleware will redirect them away
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }


    /**
     * This function displays the ingredients table view for the admin dashboard which is a table of all ingredients in the DB with
     * add/edit/delete buttons.
     *
     * Note: this function does not pass ingredients data to the view instead this is handled by a separate AJAX post method to allow
     * for pagination, searching and sorting.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ingredients(Request $request)
    {
        $title = "Ingredients";
        if (session('ingredient')) {
            $ingredient = session('ingredient');
            return view('admin.admin-ingredients', compact('title', 'ingredient'));
        } elseif (session('failedInUse')) {
            $failedInUse = session('failedInUse');
            return view('admin.admin-ingredients', compact('title', 'failedInUse'));
        } else {
            return view('admin.admin-ingredients', compact('title'));
        }

    }

    /**
     * This function handles post requests from the ingredients table view to populate and sort the table.
     *
     * @param Request $request
     */
    public function ingredientsPost(Request $request)
    {
        // Sortable columns
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'category',
            3 => 'in_recipes'
        );

        // Get how many items there are in the collection to return to the client for displaying
        $totalData = Ingredient::count();
        $totalFiltered = $totalData;

        // Table parameters for filtering and sorting received from the client request
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        // retrieve all data if no search terms were provided
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
        // otherwise filter the collection based on the search terms
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

        // if results were found above to display, render the row for the table for each result.
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

        // Return the data to the view to be displayed in the table
        echo json_encode($json_data);
    }

    /**
     * This function accepts an id value and displays the matching ingredient in the ingredient form for both
     * viewing and editing.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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

    /**
     * This function provides a blank ingredient form for entering a new ingredient.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addIngredient(Request $request)
    {
        $title = 'Add Ingredient';
        $categories = IngredientCategory::all();
        return view('admin.admin-ingredients-form', compact('title', 'categories'));
    }

    /**
     * When a new ingredient is posted by the client this function saves that ingredient to the database and redirects
     * the client back to the ingredients table with a success message.
     *
     * Note: as we are using a custom request object AdminIngredientFormRequest we can assume here the ingredient is valid
     * as the request object has already validated it.
     *
     * @param AdminIngredientFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * When the client returns updated values for a Ingredient via a put call this method updates the database and
     * returns the user to the Ingredients table with a success message.
     *
     * Note: as we are using a custom request object AdminIngredientFormRequest we can assume here the Ingredient is valid
     * as the request object has already validated it.
     *
     * @param $id
     * @param AdminIngredientFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * When a delete request is received from the client this message looks for the id in the database, deletes the row
     * and then returns the user to the ingredients table view.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteIngredient($id, Request $request)
    {
        $ingredient = Ingredient::find($id);
        if ($ingredient) {
            if (count($ingredient->recipes) == 0) {
                $ingredient->delete();
                return redirect()->route('admin.ingredients');
            } else {
                return redirect()->route('admin.ingredients')->with(['failedInUse' => $ingredient]);
            }
        } else {
            return redirect()->route('admin.ingredients');
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
