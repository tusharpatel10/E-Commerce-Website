<?php

namespace App\Http\Controllers;

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
        return view('admin.user_list',compact('users'));
    }
}
