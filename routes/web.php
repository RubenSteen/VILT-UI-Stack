<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Examples
|--------------------------------------------------------------------------
|
| Route::get('users', ['as' => 'user.index',    'uses' => 'UserController@index']);
| Route::get('user/create', ['as' => 'user.create', 'uses' => 'UserController@create']);
| Route::post('user', ['as' => 'user.store',    'uses' => 'UserController@store']);
| Route::get('user/{user_id}', ['as' => 'user.show',    'uses' => 'UserController@show']);
| Route::get('user/{user_id}/edit', ['as' => 'user.edit',   'uses' => 'UserController@edit']);
| Route::patch('user/{user_id}', ['as' => 'user.update',    'uses' => 'UserController@update']);
| Route::delete('user/{user_id}', ['as' => 'user.delete',   'uses' => 'UserController@delete']);
| Route::put('user/{user_id}', ['as' => 'user.restore', 'uses' => 'UserController@restore']);
|
| For autodiscovery use {user:id} instead of ${user_id}
*/

/*
|--------------------------------------------------------------------------
| Routes with or without authentication
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return Inertia\Inertia::render('Landing');
})->name('home');

// Forgot password routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

/*
|--------------------------------------------------------------------------
| Guests routes (must be unauthenticated)
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['guest']], function () {
    // Login routes
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');

    // Register routes
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});
/*
|--------------------------------------------------------------------------
| Routes behind authentication
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['auth']], function () {

    // Confirm password prompt routes.
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    // Logout route(s)
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Verify email when registering (disabled by default https://laravel.com/docs/master/verification)
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify')->middleware(['signed', 'throttle:6,1']);
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend')->middleware('throttle:6,1');

    // Profile routes
    Route::get('profile', ['as' => 'profile.edit',   'uses' => 'ProfileController@edit', 'middleware' => ['password.confirm']]);
    Route::patch('profile', ['as' => 'profile.update',    'uses' => 'ProfileController@update', 'middleware' => ['password.confirm']]);
    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['middleware' => ['admin'], 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

        // User routes
        Route::get('users', ['as' => 'user.index',    'uses' => 'UserController@index']);
        Route::get('user/{user_username}', ['as' => 'user.show',    'uses' => 'UserController@show']);
        Route::delete('user/{user_username}', ['as' => 'user.delete',   'uses' => 'UserController@delete']);
        Route::put('user/{user_username}', ['as' => 'user.restore', 'uses' => 'UserController@restore']);

    });
});
