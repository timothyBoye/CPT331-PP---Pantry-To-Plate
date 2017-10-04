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

class AdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }



    public function users(Request $request)
    {
        $title = "Users";
        $users = User::paginate(10);
        if (session('user')) {
            $user = session('user');
            return view('admin.admin-users', compact('title', 'users', 'user'));
        } else {
            return view('admin.admin-users', compact('title', 'users'));
        }
    }

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

    public function addUser(Request $request)
    {
        $title = 'Add User';
        $userRoles = UserRole::all();
        return view('admin.admin-users-form', compact('title', 'userRoles'));
    }

    public function postUser(AdminUserFormRequest $request)
    {
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->all());
        $user->save();
        return redirect()->route('admin.users')->with(['user' => $user]);
    }

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

    public function seedString(Request $request)
    {
        $response = "\App\User::create(array(";
        $response = $response."'name' => '".$request["name"]."', ";
        $response = $response."'email' => '".$request["email"]."', ";
        $response = $response."'password' => '".Hash::make('$request["password"]')."', ";
        $response = $response."'user_role_id' => '".$request["user_role_id"]."'";
        $response = $response."));";

        return response()->json($response, 200);
    }
}
