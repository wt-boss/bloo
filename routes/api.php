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

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->prefix('auth')->namespace('Auth')->group(function() {
    Route::apiResource('operations','OperationController');
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::middleware('api')->prefix('auth')->namespace('API')->group(function() {
    Route::apiResource('operations','OperationController');
    Route::post('pieces','UsersController@pieces');
    Route::post('operationsville/{id}','OperationController@searchoperation');
    Route::post('/operationsuser','UsersController@useroperation');});

Route::get('/getcountries','API\LocationController@getcountries');
Route::get('/getstates/{id}','API\LocationController@getstates');
Route::get('/getcities/{id}','API\LocationController@getcities');


