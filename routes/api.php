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

    Route::post('operationsville','OperationController@searchoperation');
    Route::post('/operationsuser','UsersController@useroperation');});


Route::post('pieces','API\UsersController@pieces');
Route::get('/getcountries','API\LocationController@getcountries');
Route::get('/getstates/{id}','API\LocationController@getstates');
Route::get('/getcities/{id}','API\LocationController@getcities');

Route::get('/getcitiesoperations','API\LocationController@getoperationscities');

/** Villes dans lesquelles il y'a eu une operation */
Route::get('/usercityoperation','API\UsersController@cityoperation');

/**Recuperer une ville grace a son id */
Route::get('/getcity/{id}','API\UsersController@getcity');


Route::post('forms/{form}/responses', 'API\ResponceController@store')->name('forms.responses.store.mobile');

// Route::get('giren', 'API\ResponceController@store')->name('forms.responses.store.mobile');



// API V1.1
Route::namespace('ApiV1')->prefix('v1.1')->middleware(['api'])->group(function(){
    
    // Authentication routes
    // Route::prefix('auth')->middleware(['auth'])->group(function(){
    //     Route::post('login', 'AuthController@login');
    //     Route::post('logout', 'AuthController@logout');
    //     Route::patch('refresh', 'AuthController@refreshToken');
    // });
    
    Route::post('/user', 'UserController@store');
    Route::prefix('user')->middleware('auth')->group(function(){
        Route::get('/', 'UserController@show');
        Route::patch('/', 'UserController@update');
    });

});