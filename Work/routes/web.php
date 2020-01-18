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

Route::middleware(['auth','access'])->name('admin.')->prefix('admin')->group(function(){
    Route::post('/set_options','Admin\PanelControlController@setOptions')->name('set_options');

    Route::name('user_managment.')->prefix('user_managment')->group(function(){
        Route::get('get_users','Admin\UserManagmentController@getUsers')->name('get_users');

        Route::post('save','Admin\UserManagmentController@save')->name('save');
        Route::post('delete/{user_id}','Admin\UserManagmentController@delete')->name('set_options');
        Route::post('edit/{user_id}','Admin\UserManagmentController@edit')->name('set_options');
    });

    Route::name('timetable.')->prefix('timetable')->group(function(){
        Route::get('get_group_by_departament_id','Admin\TimeTableController@getGroupByDepartamentId')->name('get_group_by_departament_id');
        Route::post('save','Admin\TimeTableController@save')->name('get_group_by_departament_id');
        Route::get('get_schedule_by_group_id','Admin\TimeTableController@getScheduleByGroupId')->name('get_schedule_by_group_id');
    }); 
});




