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
    Route::get('/user_managment','Admin\UserManagmentController@index')->name('user_managment');
    Route::get('/panel_control','Admin\PanelControlController@index')->name('panel_control');
    Route::get('/file_management','Admin\WarningController@index')->name('file_management');
    Route::get('/timetable','Admin\TimetableController@index')->name('timetable');
    Route::get('/callschedule','Admin\CallScheduleController@index')->name('callschedule');
    Route::get('/requestsusers','Admin\WarningController@index')->name('requestsusers');
    Route::get('/department_managment','Admin\DepartmentManagmentController@index')->name('departments');
    Route::get('/group_managment','Admin\WarningController@index')->name('groups');
    Route::get('/post_managment','Admin\WarningController@index')->name('posts');
    Route::get('/place_managment','Admin\PlaceManagmentController@index')->name('place_managment');
    Route::get('/additional_education_managment','Admin\WarningController@index')->name('additional_education');
});

Route::middleware(['auth','access'])->name('student.')->prefix('student')->group(function(){
    Route::get('/home', 'Student\HomeController@index')->name('home');
    Route::get('/bio','Student\WarningController@index')->name('bio');
    Route::get('/timetable','Student\WarningController@index')->name('timetable');
    Route::get('/changes','Student\WarningController@index')->name('changes');
    Route::get('/exams','Student\WarningController@index')->name('exams');
    Route::get('/homework','Student\WarningController@index')->name('homework');
    Route::get('/progress','Student\WarningController@index')->name('progress');
    Route::get('/teachers','Student\WarningController@index')->name('teachers');
    Route::get('/blueprints','Student\WarningController@index')->name('blueprints');
    Route::get('/drivingschool','Student\WarningController@index')->name('drivingschool');
    Route::get('/certificate','Student\WarningController@index')->name('certificate');
    Route::get('/petition','Student\WarningController@index')->name('petition');
    Route::get('/psych','Student\WarningController@index')->name('psych');
    Route::get('/photos','Student\WarningController@index')->name('photos');
    Route::get('/competitions','Student\WarningController@index')->name('competitions');
    Route::get('/sportlife','Student\WarningController@index')->name('sportlife');
    Route::get('/datastorage','Student\WarningController@index')->name('datastorage');
    Route::get('/plants','Student\WarningController@index')->name('plants');
    Route::get('/convocation','Student\WarningController@index')->name('convocation');
    Route::get('/feedback','Student\WarningController@index')->name('feedback');
});




