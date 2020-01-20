<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->name('api.')->group(function () {
    Route::name('admin.')->prefix('admin')->group(function () {
        Route::post('/set_options', 'Admin\PanelControlController@setOptions')->name('set_options');

        Route::name('user_managment.')->prefix('user_managment')->group(function () {
            Route::get('get_users', 'Admin\UserManagmentController@getUsers')->name('get_users');

            Route::post('save', 'Admin\UserManagmentController@save')->name('save');
            Route::post('delete/{user_id}', 'Admin\UserManagmentController@delete')->name('set_options');
            Route::post('edit/{user_id}', 'Admin\UserManagmentController@edit')->name('set_options');
        });

        Route::name('timetable.')->prefix('timetable')->group(function () {
            Route::get('get_group_by_departament_id', 'Admin\TimeTableController@getGroupByDepartamentId')->name('get_group_by_departament_id');
            Route::post('save', 'Admin\TimeTableController@save')->name('get_group_by_departament_id');
            Route::get('get_schedule_by_group_id', 'Admin\TimeTableController@getScheduleByGroupId')->name('get_schedule_by_group_id');
        });
    });
});
