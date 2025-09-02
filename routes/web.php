<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::get('/login', 'login')->name('login');
    Route::get('/forgotPassword', 'forgotPassword')->name('forgotPassword');
});
