<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// })->name('home');


Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
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

Route::group(['prefix' => '/admin', 'middleware' => ['CheckRoles']], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin_home');
        Route::get('user-list', 'userList')->name('userList');
        Route::get('user-edit/{id}/', 'editUser')->name('admin-user-edit');
        Route::put('user-update/{id}/', 'updateUser')->name('admin-user-update');
        Route::post('user-profile-update/{id}/', 'updateUserProfile')->name('admin-user-profile-update');
        Route::get('user-profile-register', 'registerUserProfile')->name('admin-user-profile-register');
        Route::post('user-profile-register-data', 'registerUserProfileData')->name('admin-user-profile-register-data');
        Route::get('change-status-user-status/{id}/{status}', 'changeUserStatus')->name('admin-change-user-status');
    });

    Route::resource('brand', BrandsController::class);
    Route::controller(BrandsController::class)->group(function () {
        Route::post('change-brand-image/{id}', 'changeBrandImage')->name('admin-brand-image-change');
        Route::get('change-brand-status/{id}/{status?}', 'changeBrandStatus')->name('admin-change-brand-status');
    });

    Route::resource('product', ProductsController::class);
    Route::controller(ProductsController::class)->group(function () {
        Route::post('change-product-image/{id}', 'changeProductImage')->name('admin-product-image-change');
        Route::get('change-product-status/{id}/{status?}', 'changeProductStatus')->name('admin-change-product-status');
    });
});
