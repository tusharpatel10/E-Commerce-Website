<?php

namespace App\Http\Controllers;

use App\enum\roles;
use App\Events\WelcomeMail;
use App\Models\country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $countries = country::all();
        return view('layout_register', compact('countries'));
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'firstName' => 'required|min:4|max:20|string',
            'lastName' => 'required|min:4|max:10|string|different:firstName',
            'email' => 'required|email|unique:User,email',
            'password' => 'required|min:6',
            'contact' => 'numeric|nullable',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
            'profile' => 'required|mimes:jpg,jpeg,png'
        ]);
        $requestData = $request->except(['_token', 'regist']);
        $imgName = $request->firstName . '_' . rand(1111, 9999) . '.' . $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;
        $requestData['password'] = hash::make($request->password);
        $requestData['role_id'] = roles::admin;
        // echo "<pre>";
        // print_r($requestData);
        // exit;
        $user = User::create($requestData);
        $user->save();
        WelcomeMail::dispatch($user);
        return redirect()->route('home');
    }
    public function login(Request $request)
    {
        return view('layout_login');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // $user = Auth()->User();
            // echo "<pre>";
            // print_r($user);
            // exit;
            return redirect()->intended('/')->withSuccess('Login Successfull');
        } else {
            return redirect()->intended('login')->withSuccess('Please try again');
        }
    }
    public function forgotPassword(Request $request)
    {
        return view('forgot_password');
    }
}
