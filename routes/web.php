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
Route::get('/home', function() {
    return view('admin.dashboard');
})->name('home');

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
 * Email verification routes
 */
Route::get('email-verification/error', 'EmailVerificationController@getVerificationError')
    ->name('email-verification.error');

Route::get('email-verification/check/{token}', 'EmailVerificationController@getVerification')
    ->name('email-verification.check');

/**
 * Administrative Area Routes
 */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin\\'
    ], function() {

    // login routes
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');

    // protected routes
    Route::group(['middleware' => ['isVerified', 'can:admin']], function () {

        // logout routes
        Route::post('logout', 'Auth\LoginController@logout')
            ->name('logout');

        // dashboard admin routes
        Route::get('/', function () {
            return view('admin.dashboard');
        });
        Route::get('dashboard', function(){
            return view('admin.dashboard');
        })->name('dashboard');

        // All default routes for REST HTTP standard
        Route::resource('users', 'UsersController');
        Route::resource('categories', 'CategoriesController');
    });
});
