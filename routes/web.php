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
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');

    //create, delete, and view all Admins team
    Route::resource('teams', 'Admin\TeamsController', ['only' => ['index', 'create', 'store', 'destroy']]);
    Route::resource('subjects', 'Admin\SubjectsController');
    Route::resource('topics', 'Admin\TopicController');
    Route::resource('questions', 'Admin\QuestionController');
    Route::resource('guardians', 'Admin\GuardianController');
    Route::resource('students', 'Admin\StudentController');
    Route::resource('answers', 'Admin\AnswerController');
    
    //delete and view all Users ( client )
    Route::resource('clients','Admin\ClientsController', ['only' => ['index','destroy']]);

		Route::get('logout', 'Admin\AuthController@logout')->name('admin.logout');

		//Settings
    Route::get('settings', "Admin\AccountSettingsController@viewAccount")->name("admin.account.show");
    Route::post('settings', "Admin\AccountSettingsController@updateAccount")->name("admin.account.update");
    Route::put('settings/password', "Admin\AccountSettingsController@updatePassword")->name("admin.password.change");
  });
});


Route::get('/', 'Client\HomeController@home')->name('root');
Route::get('/home', 'Client\HomeController@home')->name('home');

