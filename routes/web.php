<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');


Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/storeUser', 'storeUser')->name('storeUser');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::get('/forgotPassword', 'forgotPassword')->name('forgotPassword');
    Route::post('/forgotPassword', 'sendForgotPasswordEmail')->name('sendForgotPasswordEmail');
    Route::get('/resetPassword/{token}', 'resetPassword')->name('resetPassword');
    Route::post('/resetPassword', 'resetPasswordData')->name('reset_password_data');
    Route::get('/logout', 'logout')->name('logout');
});


Route::controller(UserController::class)->group(function () {
    Route::get('profile', 'profile')->name('profile');
    Route::put('userProfileUpdate', 'userProfileUpdate')->name('userProfileUpdate');
    Route::post('User-Image-Update', 'UserImageUpdate')->name('UserImageUpdate');
});
