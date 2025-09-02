<?php

namespace App\Http\Controllers;

use App\Models\country;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $countries = country::all();
        return view('layout_register',compact('countries'));
    }
    public function login(Request $request)
    {
        return view('layout_login');
    }
    public function forgotPassword(Request $request)
    {
        return view('forgot_password');
    }
}
