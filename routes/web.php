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

 Route::get('/home', function () {
     return view('pages.home');
 });
Route::get('/test', function () {
    return view('offres.oneshot');
});

Route::get('/test2', function () {
    return view('adminlte.home');
});

Auth::routes();

Route::resource('users','UsersController');

//Questionnaire get

Route::get('/home2', 'HomeController@index2')->name('home2');
Route::get('/take_survey/{slug}', 'QuestionnaireController@view')->name('take_survey');
Route::get('/stat_survey', 'HomeController@index')->name('stat_survey');
Route::get('/questionnaire/create','QuestionnaireController@create')->name('questionnaire.create');
Route::get('/questionnaire/{slug}/edit','QuestionnaireController@edit')->name('questionnaire.edit');
Route::get('/questionnaire/{questionnaire}','QuestionnaireController@show')->name('questionnaire.show');
Route::get('/questionnaire/stats/{questionnaire}','QuestionnaireController@stats')->name('questionnaire.stat');
Route::get('/questionnaire/create/free','QuestionnaireController@free')->name('questionnaire.free');
Route::get('/questionnaire/view/free','QuestionnaireController@login_free')->name('questionnaire.login_free');
Route::get('/questionnaire/create/validate/{slug}','QuestionnaireController@show_free');
Route::get('/questionnaire/create/validate/confirm/{slug}','QuestionnaireController@confirm')->name('questionnaire.confirm');
Route::get('/questionnaires/{questionnaire}/answer','QuestionController@answer_destroy');
Route::get('/admin', 'HomeController@admin')->name('admin');

//Questionnaire post

Route::post('/questionnaire','QuestionnaireController@store')->name('questionnaire.store');
Route::post('/questionnaire/update/{questionnaire}','QuestionnaireController@update')->name('questionnaire.update');
Route::post('/questionnaire/view_free','QuestionnaireController@identify_free')->name('questionnaire.identify_free');
Route::post('/questionnaire/create','QuestionnaireController@store_free')->name('questionnaire.store_free');
Route::post('/questionnaire/create/validate/{slug}','QuestionnaireController@valid')->name('questionnaire.validate_free');
Route::post('/question/{questionnaire}','QuestionController@store')->name('question.store');
Route::post('/surveys/{questionnaire}-{slug}','surveyController@store');
Route::post('/log','QuestionController@test');

Route::match(['post','get'],'/questionnaire/create/active/{questionnaire}','QuestionnaireController@active')->name('questionnaire.active');
Route::delete('/questionnaire/{questionnaire}','QuestionnaireController@destroy')->name('questionnaire.destroy');
Route::delete('/questionnaires/{questionnaire}/questions/{question}','QuestionController@destroy')->name('question.destroy');

//language
Route::get('language', 'PagesController@language')->name('language');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
Route::get('/about', function () {
    return view('about');
})->name('about');

// pages route
Route::group(['middleware'=>['web']],function(){
    Route::get('/','PagesController@getHome')->name('home');
    Route::get('services', 'PagesController@getServices')->name('services');
    Route::get('sondages', 'QuestionnaireController@free')->name('sondages');
    //Route::get('sondages', 'PagesController@getSondage')->name('sondages');
    Route::get('prix', 'PagesController@getPrix')->name('prix');

    // footer
    Route::get('apropos', 'PagesController@getApropos')->name('apropos');
    Route::get('carriere', 'PagesController@getCarriere')->name('carriere');
    Route::get('Politique_de_confidentialité', 'PagesController@getIntimite')->name('Politique_de_confidentialité');
    Route::get('Termes_&_Conditions', 'PagesController@getTc')->name('Termes_&_Conditions');

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

// offres
Route::get('/offres/primus','SurveyController@primus')->name('primus');
Route::get('/offres/illimité','SurveyController@illimité')->name('illimité');

//paypal

// route for processing payment
Route::post('paypal', 'PaymentController@payWithpaypal')->name('paypal');

// route for check status of the payment
Route::get('status/', 'PaymentController@getPaymentStatus')->name('status');

Route::get('devise','PaymentController@rates');
Route::resource('operation', 'OperationController');

