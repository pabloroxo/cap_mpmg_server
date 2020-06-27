<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
});

Route::group(['prefix' => 'user', 'namespace' => 'Auth'], function () {
    Route::get('me', 'UserController@me');
});

Route::group(['prefix' => 'account', 'namespace' => 'Auth'], function () {
    Route::post('withdraw', 'AccountController@withdraw');
    Route::post('deposit', 'AccountController@deposit');
});
