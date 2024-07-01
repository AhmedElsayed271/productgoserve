<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'users'], function(){
    Route::post('login', 'App\Http\Controllers\Api\user\authentication\LoginController@login');
    Route::post('register', 'App\Http\Controllers\Api\user\authentication\registrationController@register');

    Route::group(['middleware' => 'checkJWTTokenMiddelware:user_api'], function(){
        Route::post('logout', 'App\Http\Controllers\Api\user\authentication\LoginController@logout');

        Route::group(['prefix' => 'profile'], function(){
            Route::get('/', 'App\Http\Controllers\Api\user\authentication\profileController@show');
            Route::post('update', 'App\Http\Controllers\Api\user\authentication\profileController@update');
            Route::post('changePassword', 'App\Http\Controllers\Api\user\authentication\profileController@changePassword');
            Route::post('changeImage', 'App\Http\Controllers\Api\user\authentication\profileController@changeImage');
        });
    });
});
