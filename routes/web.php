<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');


Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/storeUser', 'storeUser')->name('storeUser');
    Route::get('/login', 'login')->name('login');
    Route::get('/forgotPassword', 'forgotPassword')->name('forgotPassword');
});
