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

Route::get('/', "WelcomeController@index")->name("default");

Auth::routes(['register' => false, 'verify' => false,'confirm'=>false]);

Route::middleware(['profilactic','auth','access'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/home', 'Admin\HomeController@index')->name('home');
    Route::get('/user_management','Admin\UserManagementController@index')->name('user_management');
    Route::get('/panel_control','Admin\PanelControlController@index')->name('panel_control');
    Route::get('/file_management','Admin\FileManagementController@index')->name('file_management');
    Route::get('/timetable','Admin\TimetableController@index')->name('timetable');
    Route::get('/replacements','Admin\ReplacementController@index')->name('replacements');
    Route::get('/callschedule','Admin\CallScheduleController@index')->name('callschedule');
    Route::get('/department_management','Admin\DepartmentManagementController@index')->name('departments');
    Route::get('/group_management','Admin\GroupManagementController@index')->name('groups');
    Route::get('/post_management','Admin\PostManagementController@index')->name('posts');
    Route::get('/place_management','Admin\PlaceManagementController@index')->name('place_management');
    Route::get('/retraining_management','Admin\RetrainingManagementController@index')->name('retraining_management');
    Route::get('/request','Admin\RequestController@index')->name('request');
});

Route::middleware(['auth','access'])->name('student.')->prefix('student')->group(function(){
    Route::get('/home', 'Student\HomeController@index')->name('home');
    Route::get('/news','WarningController@index')->name('timetable');
    Route::get('/account','Student\AccountController@index')->name('account');
    Route::get('/timetable','WarningController@index')->name('timetable');
    Route::get('/changes','WarningController@index')->name('changes');
    Route::get('/exams','WarningController@index')->name('exams');
    Route::get('/homework','WarningController@index')->name('homework');
    Route::get('/progress','WarningController@index')->name('progress');
    Route::get('/teachers','WarningController@index')->name('teachers');
    Route::get('/replacements','WarningController@index')->name('replacements');
    Route::get('/blueprints','WarningController@index')->name('blueprints');
    Route::get('/drivingschool','WarningController@index')->name('drivingschool');
    Route::get('/certificate','WarningController@index')->name('certificate');
    Route::get('/petition','WarningController@index')->name('petition');
    Route::get('/psych','WarningController@index')->name('psych');
    Route::get('/photos','WarningController@index')->name('photos');
    Route::get('/competitions','WarningController@index')->name('competitions');
    Route::get('/sportlife','WarningController@index')->name('sportlife');
    Route::get('/datastorage','WarningController@index')->name('datastorage');
    Route::get('/plants','WarningController@index')->name('plants');
    Route::get('/convocation','WarningController@index')->name('convocation');
    Route::get('/feedback','FeedbackController@index')->name('feedback');
});

Route::middleware(['profilactic','auth','access'])->name('teacher.')->prefix('teacher')->group(function(){
    Route::get('/home', 'Teacher\HomeController@index')->name('home');
    Route::get('/feedback','WarningController@index')->name('feedback');
});

Route::middleware(['profilactic','auth','access'])->name('unit.')->prefix('unit')->group(function(){
    Route::get('/home', 'Unit\HomeController@index')->name('home');
    Route::get('/feedback','WarningController@index')->name('feedback');
});

Route::middleware(['profilactic','auth','access'])->name('lord.')->prefix('lord')->group(function(){
    Route::get('/home', 'Chancellery\HomeController@index')->name('home');
    Route::get('/listcertificate', 'Chancellery\ListCertificateController@index')->name('list_certificate');
    Route::get('/feedback','WarningController@index')->name('feedback');
});

Route::middleware(['profilactic','auth','access'])->name('nullfunc.')->prefix('nullfunc')->group(function(){
    Route::get('/home', 'Nullfunc\HomeController@index')->name('home');
    Route::get('/feedback','WarningController@index')->name('feedback');
});