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

Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');

Route::get('usersprm', 'API\UserPRMController@index');
Route::get('health/{type}', 'API\UserPRMController@health');

Route::middleware('auth:api')->group( function () {
    Route::resource('files', 'API\FileController');
});
