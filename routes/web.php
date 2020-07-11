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
})->middleware('verified');

Route::get('/top', function () {
    return view('admin.top-nav');
});

Route::get('/kai', function () {
    return view('testing');
});

Route::resource('users','UsersController');

Route::get('/test2', function () {
    return view('adminlte.home');
});

Route::get('listlecteurs/{id}','OperationController@listLecteurs');
Route::get('listoperateurs','OperationController@listOperateurs');
Route::post('/addlecteurs/id','OperationController@addlecteurs')->name('ajoutlecteur');

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
    Route::get('sondages', 'QuestionnaireController@free')->name('sondages');
    //Route::get('sondages', 'PagesController@getSondage')->name('sondages');
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
Route::get('/administration', 'HomeController@admin')->name('admin');

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
//Route::get('/profile', 'ProfileController@index')->name('profile');
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
Route::resource('operation', 'OperationController');
Route::post('subscribe', 'NewletterController@store')->name('subscribe');


//Messagerie Route
Route::get('messages','MessageController@index')->name('messages_index');
Route::get('messages_show/{operation}','MessageController@show')->name('messages_show');
Route::get('/private-message/{user}/{operation}','MessageController@privateMessages');
Route::post('/private-message/{user}/{operation}','MessageController@sendPrivateMessage');
Route::get('/users_list','MessageController@users');
