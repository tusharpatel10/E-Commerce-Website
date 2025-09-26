<?php

namespace App\Http\Controllers;

use App\enum\User_Status;
use App\Models\country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Events\WelcomeMail;
use Illuminate\Queue\Jobs\RedisJob;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function userList(Request $request)
    {
        $users = User::all();
        $countries = country::all();
        // echo "<pre>";
        // print_r($users[1]->countryData);
        // exit;
        return view('admin.user_list', compact('users', 'countries'), [], 301);
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

    public function updateUser(Request $request, $id)
    {

        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $requestData = $request->except('token', 'method', 'update');
        $request->validate([
            'firstName' => 'required|min:4|max:20|string',
            'lastName' => 'required|min:4|max:10|string|different:firstName',
            'email' => 'required|email',
            'contact' => 'numeric|nullable',
            'gender' => 'required|in:Male,Female',
            'role_id' => 'required|in:0,1',
            'address' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
        ]);
        $user = User::find($id);
        if (!empty($user)) {
            $user->update($requestData);
            return redirect()->route('userList', [], 301)->with('success', 'Users Profile has been updated Successfully.');
        } else {
            return redirect()->route('userList', [], 301)->with('danger', 'Something went.');
        }
    }

    public function updateUserProfile(Request $request, $id)
    {
        $request->validate([
            'profile' => 'required|mimes:png,jpg,jpeg'
        ]);
        $requestData = $request->except(['_token', '_method', 'updateProfile']);
        $user = User::find($id);
        $imgName = $user->firstName . '_' . rand(1111, 9999) . '.' . $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;
        if (!empty($user)) {
            $existingProfile = $user->profile;
            $user->update($requestData);
            $profileExists = public_path("profiles/$existingProfile");
            if (file_exists($profileExists)) {
                unlink("profiles/$existingProfile");
                return redirect()->route('userList')->with('success', 'Users Profile Picture has been update Successfully.');
            }
            return redirect()->route('userList')->with('success', 'Users has been New Profile Picture update Successfully.');
        } else {
            return redirect()->route('userList')->with('danger', 'Something went.');
        }
    }

    // Admin side User Registration Method
    public function registerUserProfile(Request $request)
    {
        $countries = country::all();
        return view('admin.user_register', compact('countries'));
    }

    public function registerUserProfileData(Request $request)
    {
        $request->validate([
            'firstName' => 'required|min:4|max:20|string',
            'lastName' => 'required|min:4|max:10|string|different:firstName',
            'email' => 'required|email|unique:User,email',
            'password' => 'required|min:6',
            'contact' => 'numeric|nullable',
            'gender' => 'required|in:Male,Female',
            'role_id' => 'required|in:0,1',
            'address' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
            'profile' => 'required|mimes:jpg,jpeg,png'
        ]);
        $requestData = $request->except(['_token', 'regist']);
        $imgName = $request->firstName . '_' . rand(1111, 9999) . '.' . $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;
        $requestData['password'] = hash::make($request->password);
        $user = User::create($requestData);
        WelcomeMail::dispatch($user);
        if (!empty($user)) {
            $user->update($requestData);
            return redirect()->route('userList', [], 301)->with('success', 'Users Profile has been Register Successfully.');
        } else {
            return redirect()->route('userList', [], 301)->with('danger', 'Something went.');
        }
    }

    public function changeUserStatus(Request $request, $id, $status = 1)
    {
        $user = User::find($id);
        if (!empty($user)) {
            $user->is_active = $status;
            $user->save();
            return redirect()->route('userList')->with('success', "User status updated successfully");
        } else {
            return redirect()->route('userList')->with('danger', "Somethin went wrong");
        }
    }
}
