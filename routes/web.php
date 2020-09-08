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

/**Front  End */

Route::redirect('/', 'forms')->name('home')->middleware('Free');
Route::get('/home', function () {
    return view('pages.home');
})->middleware('Free');

// pages route
Route::group(['middleware'=>['web','Free']],function(){
    Route::get('/','PagesController@getHome')->name('home');
    Route::get('services', 'PagesController@getServices')->name('services');
    Route::get('sondages', 'PagesController@getSondage')->name('sondages');
    Route::get('prix', 'PagesController@getPrix')->name('prix');

    // footer
    Route::get('apropos', 'PagesController@getApropos')->name('apropos');
    Route::get('carriere', 'PagesController@getCarriere')->name('carriere');
    Route::get('intimite', 'PagesController@getIntimite')->name('intimite');
    Route::get('tc', 'PagesController@getTc')->name('tc');
    Route::get('mail_lecteur', 'PagesController@mail_lecteur')->name('mail_lecteur');
    Route::get('mail_operateur', 'PagesController@mail_operateur')->name('mail_operateur');
    Route::get('mail_client', 'PagesController@mail_client')->name('mail_client');
    //contact
    Route::get('/contact', [
        "as"=>'contact_path',
        'uses'=>'ContactsController@create'
    ])->name('contact')->middleware('Free');
    Route::post('/contact', [
        "as"=>'contact_path',
        'uses'=>'ContactsController@store'
    ])->middleware('Free');
    Route::get('/test-email', function () {
        return new ContactMessageCreated('kirra belloche','kirraridibo@gmail.com','uste un test email', 'Merci pour bloo');
    })->middleware('Free');
});

// pages route
Route::group(['middleware'=>['web','Free']],function(){
    Route::get('/','PagesController@getHome')->name('home');
    Route::get('services', 'PagesController@getServices')->name('services');
    //Route::get('sondages', 'PagesController@getSondage')->name('sondages');
    Route::get('prix', 'PagesController@getPrix')->name('prix');
    // footer
    Route::get('apropos', 'PagesController@getApropos')->name('apropos');
    Route::get('carriere', 'PagesController@getCarriere')->name('carriere');
    Route::get('Politique_de_confidentialite', 'PagesController@getIntimite')->name('Politique_de_confidentialité');
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
//route pour carriere
Route::get('cv_submit', 'FileUploadController@cv')->name('cv_submit')->middleware('Free');
Route::post('cv_submit', 'FileUploadController@cv')->name('cv_submit')->middleware('Free');

// offres
Route::get('/offres/primus','SurveyController@primus')->name('primus')->middleware('Free');
Route::get('/offres/illimité','SurveyController@illimité')->name('illimité')->middleware('Free');


/**Back End */


Route::resource('users','UsersController')->middleware('Free');

Route::get('listlecteurs/{id}','OperationController@listLecteurs');
Route::get('listoperateurs/{id}','OperationController@listOperateurs');
Route::post('/addlecteurs','OperationController@addlecteurs')->name('ajoutlecteur');
Route::post('/addoperateurs','OperationController@addoperateurs')->name('ajoutoperateur');
Route::get('/removelecteurs/{id}/{id1}','OperationController@removelecteur');
Route::get('/removeoperateurs/{id}/{id1}','OperationController@removeoperateur');
Route::namespace('Form')->group(function () {
    Route::get('forms/{form}/view', 'FormController@viewForm')->name('forms.view');
    Route::post('forms/{form}/responses', 'ResponseController@store')->name('forms.responses.store');
});


// Authentication Routes...
Auth::routes(['verify' => true]);

Route::namespace('Auth')->group(function () {
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register.show')->middleware('Free');
    Route::post('register', 'RegisterController@register')->name('register')->middleware('Free');
    //Login Routes
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

//Dashboard Routes
Route::get('profile', 'ProfileController@index')->name('profile.index');
Route::put('profile', 'ProfileController@update')->name('profile.update');
Route::get('entreprise','OperationController@entreprise')->name('entreprise');
Route::post('entreprise', 'OperationController@saventreprise')->name('saventreprise');


Route::namespace('Form')->group(function () {
    //free Form Route
    Route::post('forms_free', 'FormController@store_free')->name('forms.store_free');
    Route::post('form_free', 'FormController@show_free')->name('forms.show_free');
    Route::get('logout_free', 'FormController@logout_free')->name('forms.logout_free');
});

Route::middleware(['auth'])->namespace('Form')->group(function () {
    //Form Routes
    Route::get('forms', 'FormController@index')->name('forms.index');
    Route::get('forms/create', 'FormController@create')->name('forms.create');
    Route::post('forms', 'FormController@store')->name('forms.store');
    Route::get('forms/{form}', 'FormController@show')->name('forms.show')->middleware('Role:Superadmin|Account Manager|Free');
    Route::get('forms/{form}/edit', 'FormController@edit')->name('forms.edit')->middleware('Role:Superadmin|Account Manager|Free');
    Route::put('forms/{form}', 'FormController@update')->name('forms.update')->middleware('Role:Superadmin|Account Manager|Free');
    Route::delete('forms/{form}', 'FormController@destroy')->name('forms.destroy')->middleware('Role:Superadmin|Account Manager');

    Route::post('forms/{form}/draft', 'FormController@draftForm')->name('forms.draft')->middleware('Role:Superadmin|Account Manager|Free');
    Route::get('forms/{form}/preview', 'FormController@previewForm')->name('forms.preview')->middleware('Role:Superadmin|Account Manager|Free');
    Route::post('forms/{form}/open', 'FormController@openFormForResponse')->name('forms.open')->middleware('Role:Superadmin|Account Manager|Free');
    Route::post('forms/{form}/close', 'FormController@closeFormToResponse')->name('forms.close')->middleware('Role:Superadmin|Account Manager|Free');

    Route::post('forms/{form}/share-via-email', 'FormController@shareViaEmail')->name('form.share.email')->middleware('Role:Superadmin|Account Manager|Free');
    Route::post('forms/{form}/form-availability', 'FormAvailabilityController@save')->name('form.availability.save')->middleware('Role:Superadmin|Account Manager|Free');
    Route::delete('forms/{form}/form-availability/reset', 'FormAvailabilityController@reset')->name('form.availability.reset')->middleware('Role:Superadmin|Account Manager|Free');

    //Form Field Routes
    Route::post('forms/{form}/fields/add', 'FieldController@store')->name('forms.fields.store')->middleware('Role:Superadmin|Account Manager|Free');
    Route::post('forms/{form}/fields/delete', 'FieldController@destroy')->name('forms.fields.destroy')->middleware('Role:Superadmin|Account Manager|Free');

    //Form Response Routes
    Route::get('forms/{form}/responses', 'ResponseController@index')->name('forms.responses.index')->middleware('Role:Superadmin|Account Manager|Free');
    Route::get('forms/{form}/responses/download', 'ResponseController@export')->name('forms.response.export')->middleware('Role:Superadmin|Account Manager|Free');
    Route::get('forms/{id}/responses/download2', 'ResponseController@export2')->name('forms.response.export2')->middleware('Role:Superadmin|Account Manager|Free');
    Route::delete('forms/{form}/responses', 'ResponseController@destroyAll')->name('forms.responses.destroy.all')->middleware('Role:Superadmin|Account Manager|Free');
    Route::delete('forms/{form}/responses/{response}', 'ResponseController@destroy')->name('forms.responses.destroy.single')->middleware('Role:Superadmin|Account Manager|Free');

    //Form Collaborator Routes
    Route::post('forms/{form}/collaborators', 'CollaboratorController@store')->name('form.collaborators.store')->middleware('Role:Superadmin|Account Manager|Free');
    Route::delete('forms/{form}/collaborators/{collaborator}', 'CollaboratorController@destroy')->name('form.collaborator.destroy')->middleware('Role:Superadmin|Account Manager|Free');
});



Route::get('/questionnaire/create/free','PagesController@free')->name('questionnaire.free')->middleware('Free');

//Questionnaire get

Route::get('/administration', 'HomeController@admin')->name('admin')->middleware('Role:Superadmin|Account Manager|Lecteur|Opérateur','Free','verified');

//Questionnaire post

//language
Route::get('language', 'PagesController@language')->name('language');
Route::get('localization/{locale}','LocalizationController@index');
//Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');


//paypal

// route for processing payment
Route::post('paypal', 'PaymentController@payWithpaypal')->name('paypal')->middleware('Free');

// route for check status of the payment
Route::get('status/', 'PaymentController@getPaymentStatus')->name('status')->middleware('Free');
Route::get('devise','PaymentController@rates');
Route::resource('operation', 'OperationController')->middleware('auth','Free');
Route::post('subscribe', 'NewletterController@store')->name('subscribe');

//Comptes
Route::resource('compte','CompteController')->middleware('Role:Superadmin|Account Manager','Free');
Route::post('compte/gift','CompteController@savegift')->name('savegift')->middleware('Role:Superadmin|Account Manager');


//Messagerie Route
Route::get('messages','MessageController@index')->name('messages_index');
Route::post('messages_show/{operation}','MessageController@show')->name('messages_show');
Route::get('/private-message/{user}/{operation}','MessageController@privateMessages');
Route::post('/private-message/{user}/{operation}','MessageController@sendPrivateMessage');
Route::get('/users_list','MessageController@users');
Route::get('/message/{id}', 'MessageController@getMessage')->name('message');
Route::get('/operation_messages/{id1}/{id2}', 'MessageController@getOperationMessage')->name('operationmessage');
Route::post('message', 'MessageController@sendMessage');
Route::post('message', 'MessageController@sendMessage');


//Route Profile
Route::get('/profile','HomeController@profile')->name('profile')->middleware('auth');


Route::get('/json-lecteurs','OperationController@listLecteurs');
Route::get('/json-lecteursoperations','OperationController@getoperationLecteurs');
Route::get('/json-operateuroperations','OperationController@getoperationOperateurs');
Route::get('/json-manageroperations','OperationController@getoperationManager');
Route::get('/json-operateurs','OperationController@listOperateurs');
Route::get('/json-states','CompteController@getregions');
Route::get('/json-cities','CompteController@getvilles');
Route::get('/json-user','MessageController@getUser');
Route::get('/json-allcountries','HomeController@allcountries');
Route::get('/json-allstates','HomeController@allstates');
Route::get('/json-allcities','HomeController@allcities');

Route::get('/jsonmapcountries','HomeController@jsonmapcountries');
Route::get('/jsonmapcities','HomeController@jsonmapcities');
Route::get('/jsonotifications','HomeController@jsonotifications');

Route::get('/json-operateurcountries','HomeController@operateurcountries');
Route::get('/json-operateurstates','HomeController@operateurstates');
Route::get('/json-operateurcities','HomeController@operateurcities');


/**Site operation */
Route::get('operationsite/{id}','OperationController@operationsites')->name('sites');
Route::get('operationsite2/{id}','OperationController@operationsites2')->name('sites2');

/**Site routes */
Route::resource('sites','SiteController');
Route::get('sitesop/{id}','SiteController@operations')->name('siteop');

Route::get('terminer/{id}','OperationController@terminer_operation')->name('lockoperation');

Route::get('start/{id}','OperationController@debuter_operation')->name('startoperation');

Route::post('contactus','ContactsController@store')->name('contactus');

Route::get('/chartPdf', 'ChartController@index');

Route::get('/testreal/{id}','OperationController@testresponses');

Route::get('/dashreal','HomeController@realtimeboard');

Route::post('/testphotoapi','PhotoController@envoipost')->name('envoiepost');
Route::get('/vueroute/{id}','TestController@searchoperation');
Route::get('/logoutfree',function () {
    return view('logoutfree');
});
/**Activer un operateur */
Route::get('/OperateurActive/{id}','OperationController@activation')->name('activation');

