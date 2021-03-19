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
        Route::post('login', 'AuthController@login');

        Route::middleware('jwt.verify')->group(function(){
            Route::post('logout', 'AuthController@logout');
            Route::patch('refresh', 'AuthController@refreshToken');
        });
    });
    Route::post('/user', 'AuthController@register');
    
    // User's routes
    Route::prefix('user')->middleware('jwt.verify')->group(function(){
        Route::get('', 'UserController@me');
        Route::patch('', 'UserController@update');
        
        // User's pictures
        Route::prefix('piece')->group(function(){
            Route::post('', 'PieceController@uploadPiece');
            Route::get('', 'PieceController@getPiece');
            Route::patch('', 'PieceController@UpdatePiece');
        });
        
        // User's current operation
        Route::get('/operation', 'UserController@operation');
    });

    // Localizations routes
    Route::get('countries', 'LocalizationController@countries');
    Route::get('country/{id}/states', 'LocalizationController@states');
    Route::get('state/{id}/cities', 'LocalizationController@cities');
    
    // Route::fallback(function(){
    //     // $exception = new Exception;
    //     // if ($exception instanceof ModelNotFoundException) {
    //     //     return response()->json([
    //     //         'status' => 404,
    //     //         'message' => trans('model_not_found'),
    //     //     ], 404);
    //     // }else if ($exception instanceof NotFoundHttpException) {
    //     //     return response()->json([
    //     //         'status' => 404,
    //     //         'message' => trans('not_found'),
    //     //     ], 404);
    //     // }else if ($exception instanceof MethodNotAllowedHttpException) {
    //     //     return response()->json([
    //     //         'status' => 405,
    //     //         'message' => trans('wrong_method')
    //     //     ], 405);
    //     // }else if ($exception instanceof UnauthorizedHttpException) {
    //     //     return response()->json([
    //     //         'status' => 401,
    //     //         'message' => trans('unauthorized')
    //     //     ], 401);
    //     // }else{
    //         return response()->json([
    //             'status' => 500,
    //             'message' => trans('general_error')
    //         ], 500);
    //     // }
    // });
});