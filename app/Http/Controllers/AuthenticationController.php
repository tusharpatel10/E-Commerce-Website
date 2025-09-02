<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        return view('layout_register');
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
