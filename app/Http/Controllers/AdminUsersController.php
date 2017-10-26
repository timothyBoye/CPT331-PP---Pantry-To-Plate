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
use App\Http\Requests\AdminUserFormRequest;

/**
 * Class AdminUsersController
 *
 * Provides both view display and CRUD functionality for users
 *
 * @package App\Http\Controllers
 */
class AdminUsersController extends Controller
{
    /**
     * AdminUsersController constructor.
     * This function ensures the user is both logged in AND an admin user otherwise the auth middleware will redirect them away
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * This function displays the users table view for the admin dashboard which is a table of all ingredients in the DB with
     * add/edit/delete buttons.
     *
     * Note: this function does not pass users data to the view instead this is handled by a separate AJAX post method to allow
     * for pagination, searching and sorting.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users(Request $request)
    {
        $title = "Users";
        if (session('user')) {
            $user = session('user');
            return view('admin.admin-users', compact('title',  'user'));
        } else {
            return view('admin.admin-users', compact('title'));
        }
    }

    /**
     * This function handles post requests from the users table view to populate and sort the table.
     *
     * @param Request $request
     */
    public function usersPost(Request $request)
    {
        // Sortable columns
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'user_role'
        );

        // Get how many items there are in the collection to return to the client for displaying
        $totalData = User::count();
        $totalFiltered = $totalData;

        // Table parameters for filtering and sorting received from the client request
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        // retrieve all data if no search terms were provided
        if(empty($request->input('search.value'))) {
            $users = User::offset($start)
                ->leftJoin('user_roles', 'user_roles.id', '=', 'users.user_role_id')
                ->select('users.id as id', 'users.name as name', 'users.email as email', 'user_roles.user_role_name as user_role' )
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        // otherwise filter the collection based on the search terms
        else {
            $search = $request->input('search.value');

            $users =  User::offset($start)
                ->leftJoin('user_roles', 'user_roles.id', '=', 'users.user_role_id')
                ->select('users.id as id', 'users.name as name', 'users.email as email', 'user_roles.user_role_name as user_role' )
                ->limit($limit)
                ->Where('users.name', 'LIKE',"%{$search}%")
                ->orWhere('users.email', 'LIKE',"%{$search}%")
                ->orWhere('user_roles.user_role_name', 'LIKE',"%{$search}%")
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = count($users);
        }

        // if results were found above to display, render the row for the table for each result.
        $data = array();
        if(!empty($users))
        {
            foreach ($users as $user)
            {
                $csrf_field = csrf_field();

                $nestedData['id'] = $user->id;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                $nestedData['user_role'] = $user->user_role;
                // edit button
                $edit = route('admin.user.get', ['id' => $user->id]);
                $nestedData['edit'] = <<<EDIT
                    <form class="admin-table-buttons" action="{$edit}" method="GET">
                        {$csrf_field}
                        <button class="btn btn-info btn-sm" type="submit">Edit</button>
                    </form>
EDIT;

                // seed button
                $seed = route('admin.user.seeder', ['id' => $user->id]);
                $nestedData['seed'] = <<<SEED
                    <form id="seed_form_{$user->id}" class="admin-table-buttons" action="" method="POST">
                        {$csrf_field}
                        <button id="seed_button_{$user->id}" data-api-controller-url="{$seed}" class="btn btn-default btn-sm" type="button">Seed String</button>
                        <script>
                            $('#seed_button_{$user->id}').click(function(){
                                console.log('click');
                                $.ajax({
                                    url: $('#seed_button_{$user->id}').attr('data-api-controller-url'),
                                    type: 'POST',
                                    data: $('#seed_form_{$user->id}').serialize()
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
                $delete = route('admin.user.delete', ['id' => $user->id]);
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
     * This function accepts an id value and displays the matching user in the user form for both
     * viewing and editing.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getUser($id, Request $request)
    {
        $user = User::find($id);
        $title = 'Edit User';
        $userRoles = UserRole::all();
        if ($user) {
            return view('admin.admin-users-form', compact('user','title', 'userRoles'));
        } else {
            return redirect()->route('admin.users');
        }
    }

    /**
     * This function provides a blank user form for entering a new user.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addUser(Request $request)
    {
        $title = 'Add User';
        $userRoles = UserRole::all();
        return view('admin.admin-users-form', compact('title', 'userRoles'));
    }

    /**
     * When a new user is posted by the client this function saves that user to the database and redirects
     * the client back to the users table with a success message.
     *
     * Note: as we are using a custom request object AdminUserFormRequest we can assume here the user is valid
     * as the request object has already validated it.
     *
     * @param AdminUserFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUser(AdminUserFormRequest $request)
    {
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->all());
        $user->save();
        return redirect()->route('admin.users')->with(['user' => $user]);
    }

    /**
     * When the client returns updated values for a User via a put call this method updates the database and
     * returns the user to the Users table with a success message.
     *
     * Note: as we are using a custom request object AdminUserFormRequest we can assume here the User is valid
     * as the request object has already validated it.
     *
     * @param $id
     * @param AdminUserFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putUser($id, AdminUserFormRequest $request)
    {
        $user = User::find($id);
        $requestArray = [
            'name' => $request['name'],
            'email' => $request['email'],
            'user_role_id' => $request['user_role_id'],
            ];
        if (!empty($request['password'])) {
            $requestArray = array_add($requestArray, 'password',Hash::make($request['password']));
        }
        $user->update($requestArray);
        $user->save();
        return redirect()->route('admin.users')->with(['user' => $user]);
    }

    /**
     * When a delete request is received from the client this message looks for the id in the database, deletes the row
     * and then returns the user to the users table view.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id, Request $request)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.users');
        } else {
            return redirect()->route('admin.users');
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
        $user = User::find($id);
        $response = "\App\User::create(array(";
        $response = $response."'name' => '$user->name', ";
        $response = $response."'email' => '$user->email', ";
        $response = $response."'password' => '$user->password', ";
        $userRole = UserRole::where('id', '=', $user->user_role_id)->value('user_role_name');
        $response = $response."'user_role_id' => UserRole::where('user_role_name', '=', '".$userRole."')->value('id')";
        $response = $response."));";

        return response()->json($response, 200);
    }
}
