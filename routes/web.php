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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('dashboard');


Route::group(['prefix' => 'admin','as'=>'admin.'], function() {
    // Authentication Routes...
    Route::get('/', 'AuthAdmin\LoginController@showLoginForm')->name('login');
    Route::post('/', 'AuthAdmin\LoginController@login');
    Route::post('logout', 'AuthAdmin\LoginController@logout')->name('logout');
    //Password Reset Routes...
    Route::get('password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'AuthAdmin\ResetPasswordController@reset')->name('password.update');
    //Password Confirm Routes...
    Route::get('password/confirm', 'AuthAdmin\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'AuthAdmin\ConfirmPasswordController@confirm');
    //Auth Routes...
    Route::group(['middleware' => 'auth:admin','namespace'=>'Admin'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    });
    
    
});
