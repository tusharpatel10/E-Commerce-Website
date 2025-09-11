<?php

namespace App\Http\Controllers;

use App\Models\country;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $countries = country::all();
        return view('user_profile', compact('countries'));
    }
}
