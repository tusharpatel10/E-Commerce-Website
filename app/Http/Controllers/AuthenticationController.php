<?php

namespace App\Http\Controllers;

use App\enum\roles;
use App\Events\WelcomeMail;
use App\Mail\SendForgotPasswordEmail;
use App\Models\country;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('index');
    }
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
        return redirect()->route('home', [], 301)->with('success', 'Registration Account was Successfully');
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
            if (auth()->user()->role_id == roles::admin) {
                return redirect()->route('admin_home', [], 301)->withSuccess('Hello Admin, you are Login Successfull');
            } else {
                return redirect()->route('home', [], 301)->withSuccess('Hello User, you are Login Successfull');
            }
            // $user = Auth()->User();
            // echo "<pre>";
            // print_r($user);
            // exit;
        } else {
            return redirect()->route('login', [], 301)->withDanger('Please try again');
        }
    }
    public function forgotPassword(Request $request)
    {
        return view('forgot_password');
    }
    public function sendForgotPasswordEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user,email'
        ]);

        $requestData = $request->except('_token', 'forgot_pass_btn');
        $requestData['_token'] = Str::random('30');

        $forgotPasswordData = DB::table('password_resets')->insert($requestData);
        $ready = Mail::to($requestData['email'])->send(new SendForgotPasswordEmail($requestData));
        // echo "<pre>";
        // print_r($request->all());
        // exit;

        return redirect()->route('forgotPassword', [], 301)->with('success', "Your reset Password Mail was Sending Successfully.");
    }

    public function resetPassword(Request $request, $token)
    {
        $checkData = DB::table('password_resets')->where('email', $request->email)->where('_token', $token)->count();
        if ($checkData > 0) {
            $email = $request->email;
            return view('reset_password', compact('email'));
        } else {
            return redirect()->route('forgotPassword', [], 301)->with('danger', 'Invalid Token');
        }
    }
    public function resetPasswordData(Request $request)
    {
        $request->validate([
            "password" => 'required|min:6',
            "confirm_password" => 'required|same:password'
        ]);
        User::where('email', $request->email)->Update(['password' => bcrypt($request->password)]);
        return redirect()->route('login', [], 301)->with('success', 'Your Password has been Reset Successfully, You have been login.');
    }
    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
