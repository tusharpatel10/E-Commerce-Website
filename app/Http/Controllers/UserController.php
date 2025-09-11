<?php

namespace App\Http\Controllers;

use App\Models\country;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = auth()->user();
        $countries = country::all();
        return view('user_profile', compact('user', 'countries'));
    }

    public function userProfileUpdate(Request $request)
    {
        $requestData = $request->except('token', 'method', 'update');
        $request->validate([
            'firstName' => 'required|min:4|max:20|string',
            'lastName' => 'required|min:4|max:10|string|different:firstName',
            'email' => 'required|email',
            'contact' => 'numeric|nullable',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
        ]);
        $user = User::find(auth()->user()->id);
        $user->update($requestData);
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        return redirect()->route('profile')->with('success', 'Your Profile has been update Successfully');
    }
}
