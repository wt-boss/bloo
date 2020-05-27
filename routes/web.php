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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/take_survey/{questionnaire}', 'QuestionnaireController@view')->name('take_survey');
Route::get('/stat_survey', 'HomeController@index')->name('stat_survey');


Route::get('/questionnaire/create','QuestionnaireController@create')->name('questionnaire.create');
Route::post('/questionnaire','QuestionnaireController@store')->name('questionnaire.store');
Route::post('/questionnaire//update/{questionnaire}','QuestionnaireController@update')->name('questionnaire.update');
Route::get('/questionnaire/{questionnaire}','QuestionnaireController@show')->name('questionnaire.show');
Route::get('/questionnaire/stats/{questionnaire}','QuestionnaireController@stats')->name('questionnaire.stat');

Route::get('/questionnaire/{questionnaire}/edit','QuestionnaireController@edit')->name('questionnaire.edit');
Route::delete('/questionnaire/{questionnaire}','QuestionnaireController@destroy')->name('questionnaire.destroy');

Route::post('/question/{questionnaire}','QuestionController@store')->name('question.store');

Route::delete('/questionnaires/{questionnaire}/questions/{question}','QuestionController@destroy')->name('question.destroy');

Route::post('/surveys/{questionnaire}-{slug}','surveyController@store');

