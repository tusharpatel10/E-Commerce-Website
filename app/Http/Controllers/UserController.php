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

    public function UserImageUpdate(Request $request)
    {
        $requestData = $request->except(['token', 'method', 'update']);
        $imgName = auth()->user()->firstName . '_' . rand(1111, 9999) . '.' . $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;

        $user = User::find(auth()->user()->id);
        $existingProfile = $user->profile;

        $profileExists = public_path("profiles/$existingProfile");
        if (file_exists($profileExists)) {
            unlink("profiles/$existingProfile");
        }else {

        }
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $user->update($requestData);
        return redirect()->route('profile')->with('success', 'Your Profile Image has been Update Successfully');

    }
}
