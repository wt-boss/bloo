<?php

use Illuminate\Support\Facades\Route;

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
    return view('pages.home');
});
Route::get('/test', function () {
    return view('adminlte.index');
});

Route::get('/test2', function () {
    return view('adminlte.home');
});
Auth::routes();

Route::resource('users','UsersController');

Route::get('/home2', 'HomeController@index2')->name('home2');
Route::get('/take_survey/{slug}', 'QuestionnaireController@view')->name('take_survey');
Route::get('/stat_survey', 'HomeController@index')->name('stat_survey');
Route::get('/questionnaire/create','QuestionnaireController@create')->name('questionnaire.create');
Route::post('/questionnaire','QuestionnaireController@store')->name('questionnaire.store');
Route::post('/questionnaire/update/{questionnaire}','QuestionnaireController@update')->name('questionnaire.update');
Route::get('/questionnaire/{questionnaire}','QuestionnaireController@show')->name('questionnaire.show');
Route::get('/questionnaire/stats/{questionnaire}','QuestionnaireController@stats')->name('questionnaire.stat');
Route::get('/questionnaire/create/free','QuestionnaireController@free')->name('questionnaire.free');
Route::get('/questionnaire/view/free','QuestionnaireController@login_free')->name('questionnaire.login_free');

Route::post('/questionnaire/view_free','QuestionnaireController@identify_free')->name('questionnaire.identify_free');
Route::post('/questionnaire/create','QuestionnaireController@store_free')->name('questionnaire.store_free');
Route::post('/questionnaire/create/validate/{slug}','QuestionnaireController@valid')->name('questionnaire.validate_free');
Route::get('/questionnaire/create/validate/{slug}','QuestionnaireController@show_free');
Route::get('/questionnaire/create/validate/confirm/{slug}','QuestionnaireController@confirm')->name('questionnaire.confirm');


Route::match(['post','get'],'/questionnaire/create/active/{questionnaire}','QuestionnaireController@active')->name('questionnaire.active');
Route::get('/questionnaire/{questionnaire}/edit','QuestionnaireController@edit')->name('questionnaire.edit');
Route::delete('/questionnaire/{questionnaire}','QuestionnaireController@destroy')->name('questionnaire.destroy');
Route::post('/question/{questionnaire}','QuestionController@store')->name('question.store');
Route::delete('/questionnaires/{questionnaire}/questions/{question}','QuestionController@destroy')->name('question.destroy');
Route::post('/surveys/{questionnaire}-{slug}','surveyController@store');
Route::post('/log','QuestionController@test');
Route::get('/admin', 'HomeController@admin')->name('admin');
//language
Route::get('language', 'pagesController@language')->name('language');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
Route::get('/about', function () {
    return view('about');
})->name('about');
// pages route
Route::group(['middleware'=>['web']],function(){
    Route::get('home','pagesController@getHome')->name('home');
    Route::get('services', 'pagesController@getServices')->name('services');
    Route::get('sondages', 'pagesController@getSondage')->name('sondages');
    Route::get('prix', 'pagesController@getPrix')->name('prix');

    // footer
    Route::get('apropos', 'pagesController@getApropos')->name('apropos');
    Route::get('carriere', 'pagesController@getCarriere')->name('carriere');
    Route::get('intimite', 'pagesController@getIntimite')->name('intimite');
    Route::get('tc', 'pagesController@getTc')->name('tc');

    //contact
    Route::get('/contact', [
        "as"=>'contact_path',
        'uses'=>'ContactsController@create'
    ])->name('contact');
    Route::post('/contact', [
        "as"=>'contact_path',
        'uses'=>'ContactsController@store'
    ]);
    Route::get('/test-email', function () {
        return new ContactMessageCreated('kirra belloche','kirraridibo@gmail.com','uste un test email', 'Merci pour bloo');
    });


});


