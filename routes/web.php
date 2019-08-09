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
  Route::get('login','Admin\AuthController@viewLogin')->name('admin.login.show');
  Route::post('login','Admin\AuthController@login')->name('admin.login');

  Route::middleware('register.access')->group(function(){
    Route::get('register', "Admin\AuthController@viewRegister")->name('admin.register.show');
    Route::post('register', "Admin\AuthController@register")->name('admin.register');
  });

  Route::middleware('admin.auth')->group(function(){

    Route::get('/', 'Admin\DashboardController@dashboard');
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('admin.dashboard');

    Route::resource('teams', 'Admin\TeamsController');
    Route::resource('subjects', 'Admin\SubjectsController');

    Route::resource('topics', 'Admin\TopicsController');
    Route::post('subject/{subject}/topics/import', 'Admin\TopicsController@import')->name('topics.import');

    Route::resource('questions', 'Admin\QuestionsController');
    Route::post('subject/{subject}/questions/import', 'Admin\QuestionsController@import')->name('questions.import');

    Route::resource('guardians', 'Admin\GuardiansController');
    Route::resource('students', 'Admin\StudentsController');
    Route::resource('answers', 'Admin\AnswersController');
    
    Route::get('settings', "Admin\AccountSettingsController@viewAccount")->name("admin.account.show");
    Route::post('settings', "Admin\AccountSettingsController@updateAccount")->name("admin.account.update");
    Route::put('settings/password', "Admin\AccountSettingsController@updatePassword")->name("admin.password.change");

    Route::get('logout', 'Admin\AuthController@logout')->name('admin.logout');
  });
});


//Client Login
Route::get('login','Client\AuthController@viewLogin')->name('client.login.show');
Route::post('login','Client\AuthController@login')->name('login');

//Client register
Route::get('register', 'Client\AuthController@viewRegister')->name('client.register.show');
Route::post('register', "Client\AuthController@register")->name('client.register');

Route::middleware('client.auth')->group(function(){  
  // Client
  Route::get('/', 'Client\HomeController@home')->name('root');
  Route::get('/home', 'Client\HomeController@home')->name('home');
  Route::get('mcq-exam', 'Client\QuestionsController@showQuestion')->name('show.questions');

  Route::get('logout', 'Client\AuthController@logout')->name('client.logout');

  Route::get('trials', 'Client\QuizzesController@showTrials')->name('trials.questions');
  
  Route::middleware('purchased.course')->group(function(){ 
    Route::get('quizzes/topics', 'Client\QuizzesController@showTopics')->name('quizzes.topics');
    Route::get('quizzes/topics/{topic}', 'Client\QuizzesController@showQuestions')->name('quizzes.questions');
    Route::post('quizzes/topics/answer', 'Client\QuizzesController@answer')->name('quizzes.answer');

    Route::get('mcq-exam', 'Client\ExamsController@showMCQ')->name('exam.mcq');
    Route::post('mcq-exam/answer', 'Client\ExamsController@answer')->name('exam.answer');
  });
});

//added by Pat to view the frontend pages
Route::view('/edit-profile', '/client/edit-profile');
Route::view('/mcq-exam-2', '/client/mcq-exam');
Route::view('/quiz/1', '/client/quiz');
Route::view('/quiz/topics', '/client/topics');

Route::view('/unauthorized', '/client/unauthorized');

Route::view('/payment', '/client/payment/payment')->name('client.payment');
Route::view('/payment-gateway', '/client/payment/payment-gateway');
Route::view('/stripe', '/client/payment/stripe-info');