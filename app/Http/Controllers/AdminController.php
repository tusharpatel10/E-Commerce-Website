<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function userList(Request $request)
    {
        $users = User::all();
        // echo "<pre>";
        // print_r($users[1]->countryData);
        // exit;
        return view('admin.user_list', compact('users'));
    }
    public function editUser(Request $request, $id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return back()->with('warning', 'User Not Found.');
        }
        $role_id = $user->role_id;
        $countries = country::all();
        // echo "<pre>";
        // print_r($role_id);
        // exit;
        return view('admin.user_edit_profile', compact('user', 'role_id', 'countries'));
    }
}
