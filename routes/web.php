<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Default Route
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Home Route
 */
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Password Reset Routes
 */
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');

Route::post('password/reset', 'Auth\ResetPasswordController@reset');


/**
 * Administrative Area Routes
 */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin\\'
    ], function() {

    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::get('login', 'Auth\LoginController@showLoginForm')
        ->name('login');

    Route::post('login', 'Auth\LoginController@login');

    Route::group(['middleware' => 'can:admin'], function () {

        Route::post('logout', 'Auth\LoginController@logout')
            ->name('logout');

        Route::get('dashboard', function(){
            return view('admin.dashboard');
        });
    });
});
