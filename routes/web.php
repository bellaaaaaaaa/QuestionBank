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


//Admin Routes
Route::prefix('admin')->group(function(){

  //register
  Route::middleware('register.access')->group(function(){
  Route::get('register', "Admin\AuthController@viewRegister")->name('admin.register.show');
  Route::post('register', "Admin\AuthController@register")->name('admin.register');
  });
  //login
  Route::get('login','Admin\AuthController@viewLogin')->name('admin.login.show');
  Route::post('login','Admin\AuthController@login')->name('admin.login');

  Route::middleware('admin.auth')->group(function(){

    Route::get('/', 'Admin\DashboardController@dashboard');
    //dashboard
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('admin.dashboard');

    //create, delete, and view all Admins team
    Route::resource('teams', 'Admin\TeamsController');
    Route::resource('subjects', 'Admin\SubjectsController');
    Route::resource('topics', 'Admin\TopicsController');
    Route::resource('questions', 'Admin\QuestionsController');
    Route::resource('guardians', 'Admin\GuardiansController');
    Route::resource('students', 'Admin\StudentsController');
    Route::resource('answers', 'Admin\AnswersController');
    
    //delete and view all Users ( client )
    Route::resource('clients','Admin\ClientsController', ['only' => ['index','destroy']]);

		Route::get('logout', 'Admin\AuthController@logout')->name('admin.logout');

		//Settings
    Route::get('settings', "Admin\AccountSettingsController@viewAccount")->name("admin.account.show");
    Route::post('settings', "Admin\AccountSettingsController@updateAccount")->name("admin.account.update");
    Route::put('settings/password', "Admin\AccountSettingsController@updatePassword")->name("admin.password.change");
  });
});
Route::middleware('client.auth')->group(function(){
  // Client
  Route::get('/', 'Client\HomeController@home')->name('root');
  Route::get('/home', 'Client\HomeController@home')->name('home');
  Route::get('mcq-exam', 'Client\QuestionsController@showQuestion')->name('show.questions');
});

//Client Login
Route::get('login','Client\AuthController@viewLogin')->name('client.login.show');
Route::post('login','Client\AuthController@login')->name('client.login');

//Client register
Route::get('register', 'Client\AuthController@viewRegister')->name('client.register.show');
Route::post('register', "Client\AuthController@register")->name('client.register');

//added by Pat to view the frontend pages
Route::view('/quiz', '/client/quiz');
Route::view('/mcq-exam', '/client/mcq-exam');


