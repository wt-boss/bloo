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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@admin')->name('admin');
//language
Route::get('language', 'HomeController@language')->name('language');

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
           return new ContactMessageCreated('kirra belloche','kirraridibo@gmail.com','uste un test email', 'Merci pour Krada');
       });

       // dashboard route



});


