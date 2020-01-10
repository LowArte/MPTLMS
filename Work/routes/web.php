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
    Route::get('/file_management','Admin\FileManagmentController@index')->name('file_management');
    Route::get('/timetable','Admin\TimetableController@index')->name('timetable');
    Route::get('/bild_callschedule','Admin\TimetableController@index')->name('bild_callschedule');
    
});


Route::middleware(['auth','access'])->name('admin.')->prefix('admin')->group(function(){
    Route::post('/set_options','Admin\PanelControlController@setOptions')->name('set_options');

    Route::name('user_managment.')->prefix('user_managment')->group(function(){
        Route::post('save','Admin\UserManagmentController@save')->name('');
        Route::post('delete/{user_id}','Admin\UserManagmentController@delete')->name('set_options');
        Route::post('edit/{user_id}','Admin\UserManagmentController@edit')->name('set_options');
    });

    Route::name('timetable.')->prefix('timetable')->group(function(){
        Route::get('get_group_by_departament_id','Admin\TimeTableController@getGroupByDepartamentId')->name('get_group_by_departament_id');
        Route::post('save','Admin\TimeTableController@save')->name('get_group_by_departament_id');
        Route::get('get_schedule_by_group_id','Admin\TimeTableController@getScheduleByGroupId')->name('get_schedule_by_group_id');
    }); 
});




