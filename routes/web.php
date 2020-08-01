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


Route::redirect('/', 'forms')->name('home');

Route::get('/home', function () {
    return view('pages.home');
});

Route::resource('users','UsersController');

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
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register.show');
    Route::post('register', 'RegisterController@register')->name('register');

    //Login Routes
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');

    Route::post('logout', 'LoginController@logout')->name('logout');

    //User Email Verification Route
    Route::get('email/verify/{token}', 'VerificationController@verify');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
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

Route::middleware(['auth', 'verified'])->namespace('Form')->group(function () {
    //Form Routes
    Route::get('forms', 'FormController@index')->name('forms.index');
    Route::get('forms/create', 'FormController@create')->name('forms.create');
    Route::post('forms', 'FormController@store')->name('forms.store');
    Route::get('forms/{form}', 'FormController@show')->name('forms.show');
    Route::get('forms/{form}/edit', 'FormController@edit')->name('forms.edit');
    Route::put('forms/{form}', 'FormController@update')->name('forms.update');
    Route::delete('forms/{form}', 'FormController@destroy')->name('forms.destroy');

    Route::post('forms/{form}/draft', 'FormController@draftForm')->name('forms.draft');
    Route::get('forms/{form}/preview', 'FormController@previewForm')->name('forms.preview');
    Route::post('forms/{form}/open', 'FormController@openFormForResponse')->name('forms.open');
    Route::post('forms/{form}/close', 'FormController@closeFormToResponse')->name('forms.close');

    Route::post('forms/{form}/share-via-email', 'FormController@shareViaEmail')->name('form.share.email');
    Route::post('forms/{form}/form-availability', 'FormAvailabilityController@save')->name('form.availability.save');
    Route::delete('forms/{form}/form-availability/reset', 'FormAvailabilityController@reset')->name('form.availability.reset');

    //Form Field Routes
    Route::post('forms/{form}/fields/add', 'FieldController@store')->name('forms.fields.store');
    Route::post('forms/{form}/fields/delete', 'FieldController@destroy')->name('forms.fields.destroy');

    //Form Response Routes
    Route::get('forms/{form}/responses', 'ResponseController@index')->name('forms.responses.index');
    Route::get('forms/{form}/responses/download', 'ResponseController@export')->name('forms.response.export');
    Route::delete('forms/{form}/responses', 'ResponseController@destroyAll')->name('forms.responses.destroy.all');
    Route::delete('forms/{form}/responses/{response}', 'ResponseController@destroy')->name('forms.responses.destroy.single');

    //Form Collaborator Routes
    Route::post('forms/{form}/collaborators', 'CollaboratorController@store')->name('form.collaborators.store');
    Route::delete('forms/{form}/collaborators/{collaborator}', 'CollaboratorController@destroy')->name('form.collaborator.destroy');
});

// pages route
Route::group(['middleware'=>['web']],function(){
    Route::get('/','PagesController@getHome')->name('home');
    Route::get('services', 'PagesController@getServices')->name('services');
    Route::get('sondages', 'PagesController@getSondage')->name('sondages');
    Route::get('prix', 'PagesController@getPrix')->name('prix');

    // footer
    Route::get('apropos', 'PagesController@getApropos')->name('apropos');
    Route::get('carriere', 'PagesController@getCarriere')->name('carriere');
    Route::get('intimite', 'PagesController@getIntimite')->name('intimite');
    Route::get('tc', 'PagesController@getTc')->name('tc');

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
Route::get('/questionnaire/create/free','PagesController@free')->name('questionnaire.free');

//Questionnaire get

Route::get('/home2', 'HomeController@index2')->name('home2');
Route::get('/stat_survey', 'HomeController@index')->name('stat_survey');


Route::get('/administration', 'HomeController@admin')->name('admin');

//Questionnaire post

//language
Route::get('language', 'PagesController@language')->name('language');
//Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
Route::get('/about', function () {
    return view('about');
})->name('about');

// pages route
Route::group(['middleware'=>['web']],function(){
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
Route::get('cv_submit', 'FileUploadController@cv')->name('cv_submit');
Route::post('cv_submit', 'FileUploadController@cv')->name('cv_submit');

// offres
Route::get('/offres/primus','SurveyController@primus')->name('primus');
Route::get('/offres/illimité','SurveyController@illimité')->name('illimité');

//paypal

// route for processing payment
Route::post('paypal', 'PaymentController@payWithpaypal')->name('paypal');

// route for check status of the payment
Route::get('status/', 'PaymentController@getPaymentStatus')->name('status');
Route::get('devise','PaymentController@rates');
Route::resource('operation', 'OperationController')->middleware('auth');
Route::post('subscribe', 'NewletterController@store')->name('subscribe');

//Comptes
Route::resource('compte','CompteController')->middleware('Role:Superadmin|Account Manager');
Route::get('comptes/gift','CompteController@donner')->name('giftoperation')->middleware('Role:Superadmin|Account Manager');
Route::post('comptes/gift','CompteController@savegift')->name('savegift')->middleware('Role:Superadmin|Account Manager');


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

Route::get('/testing', function() {
    $pusher = App::make('pusher');

    $pusher->trigger( 'test-channel',
        'test-event',
        array('text' => 'Preparing the Pusher Laracon.eu workshop!'));

    return view('welcome');
});

Route::get('/json-lecteurs','OperationController@listLecteurs');
Route::get('/json-lecteursoperations','OperationController@getoperationLecteurs');
Route::get('/json-operateuroperations','OperationController@getoperationOperateurs');
Route::get('/json-operateurs','OperationController@listOperateurs');
Route::get('/json-user','MessageController@getUser');

Route::middleware('api')->prefix('auth')->namespace('Auth')->group(function() {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
