<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Exception;
// use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
// use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
Route::namespace('ApiV1')->prefix('v1.1')->middleware('api')->group(function(){

    // Authentication routes
    Route::prefix('auth')->group(function(){
        
        /* Log user in and generate a token with 6 months ttl
            Returns:
            1. 200 with "true" status if authentication has been successfully passed
            2. 200 with "false" status if something has failed like "user doesn't exists", "account disabled" or "credentials not match"
        */
        Route::post('login', 'AuthController@login');

        Route::middleware('jwt.verify')->group(function(){
            /* Log the current user out and invalidate his token
                Returns:
                1. 200 with "true" status if authentication has been successfully passed
                2. 500 if an exception occured
            */
            Route::post('logout', 'AuthController@logout');

            /* Refresh current user's token by invalidate the current and create a new
                Returns:
                1. 200 with "true" status if token has been successfully refreshed
                2. 500 if an exception occured
            */
            Route::patch('refresh', 'AuthController@refreshToken');
        });
    });
    /* Create new account and generate token to it
        Returns:
        1. 422 status if validation fails
        2. 201 if creation has been successfully passed
        3. 500 if an exception occured
    */
    Route::post('/user', 'UserController@register');
    // User's routes
    Route::prefix('user')->middleware(['jwt.verify'])->group(function(){
        /* Save user's device token
            1. 422 if device token is not present
            2. 200 if saving successfull
            3. 500 if an exception occured
        */
        Route::patch('device-token', 'AuthController@saveDeviceToken');

        /* Update user's availability
            1. 200 if availabilty has been successfully updated
            2. 500 if an exception occured
        */
        Route::get('available', 'AuthController@available');

        /* Display current user's informations
            Returns:
            1. 200 with "true" status if no problem
            2. 500 if an exception occured
        */
        Route::get('', 'UserController@me');

        /* Update current user's informations
            Returns:
            1. 422 status if validation fails
            2. 200 with "true" status if updating has been successfully passed
            3. 500 if an exception occured
        */
        Route::patch('', 'UserController@update');

        /* User's pieces
        I. POST: Save user's pieces
            1. 422 if validation fails
            2. 201 if pieces have been successfully saved
            3. 500 if an exception occured
        II. GET: Display user's pieces
            1. 200 with "true" status if no problem
            2. 500 if an exception occured
        */
        Route::apiResource('piece', 'PieceController')->except('show', 'destroy', 'update');

        /* Display user's operation(s)
            Returns:
            1. 200 with "true" status if found at least one operation
            2. 200 with "false" status if null content
            3. 500 if an exception occured
        */
        Route::middleware('operator')->group(function(){
            // User's current operation
            Route::get('/operation', 'OperationsController@operation');
            // User's passed operations
            Route::get('/operations', 'OperationsController@passedOperations');
        });

    });

    // Operations routes
    /* Display not begin operation(s) for $this city
        Returns:
        1. 200 with "true" status if found at least one operation
        2. 200 with "false" status if null content
        3. 500 if an exception occured
    */
    Route::get('cities/{city_id}/operations', 'OperationsController@cityOperations');

    /* Display sites for $this operation and $this city
        Returns:
        1. 200 with "true" status if found at least one site
        2. 200 with "false" status if null content
        3. 500 if an exception occured
    */
    Route::get('operations/{operation_id}/cities/{city_id}/sites', 'OperationsController@operationSites');

    /* Display cities (for $this user country) where there are not begin operation (s)
        Returns:
        1. 200 with "true" status if found at least one cities
        2. 200 with "false" status if null content
        3. 500 if an exception occured
    */
    Route::get('country/operations/cities', 'OperationsController@operationsCities');

    // Localizations routes
    /* Display localizations (countries, states or cities)
        Returns:
        1. 200 with "true" status if found at least one resource
        2. 200 with "false" status if null content
        3. 500 if an exception occured
    */
    Route::get('countries', 'LocalizationController@countries');
    Route::get('countries/{country_id}/states', 'LocalizationController@states');
    Route::get('states/{state_id}/cities', 'LocalizationController@cities');
});
