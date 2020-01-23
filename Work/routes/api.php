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

        Route::name('place_managment.')->prefix('place_managment')->group(function(){
            Route::get('get_places','Admin\PlaceManagmentController@getPlaces')->name('get_places');
            Route::post('save','Admin\PlaceManagmentController@save')->name('save');
            Route::post('delete/{post_id}','Admin\PlaceManagmentController@delete')->name('set_options');
            Route::post('edit/{post_id}','Admin\PlaceManagmentController@edit')->name('set_options');
        });

        Route::name('department_managment.')->prefix('department_managment')->group(function(){
            Route::get('get_departments','Admin\DepartmentManagmentController@getDepartments')->name('get_departments');
            Route::post('save','Admin\DepartmentManagmentController@save')->name('save');
            Route::post('delete/{department_id}','Admin\DepartmentManagmentController@delete')->name('set_options');
            Route::post('edit/{department_id}','Admin\DepartmentManagmentController@edit')->name('set_options');
        });

        Route::name('group_managment.')->prefix('group_managment')->group(function(){
            Route::get('get_groups','Admin\GroupManagmentController@getGroups')->name('get_groups');
            Route::post('save','Admin\GroupManagmentController@save')->name('save');
            Route::post('delete/{group_id}','Admin\GroupManagmentController@delete')->name('set_options');
            Route::post('edit/group_id}','Admin\GroupManagmentController@edit')->name('set_options');
        });

        Route::name('post_managment.')->prefix('post_managment')->group(function(){
            Route::get('get_posts','Admin\PostManagmentController@getPosts')->name('get_posts');
            Route::post('save','Admin\PostManagmentController@save')->name('save');
            Route::post('delete/{post_id}','Admin\PostManagmentController@delete')->name('set_options');
            Route::post('edit/{post_id}','Admin\PostManagmentController@edit')->name('set_options');
        });

        Route::name('retraining_managment.')->prefix('retraining_managment')->group(function(){
            Route::get('get_retrainings','Admin\RetrainingManagmentController@getRetraining')->name('get_retraining');
            Route::post('save','Admin\RetrainingManagmentController@save')->name('save');
            Route::post('delete/{get_retraining_id}','Admin\RetrainingManagmentController@delete')->name('set_options');
            Route::post('edit/{get_retraining_id}','Admin\RetrainingManagmentController@edit')->name('set_options');
        });

        Route::name('timetable.')->prefix('timetable')->group(function () {
            Route::get('get_group_by_departament_id', 'Admin\TimeTableController@getGroupByDepartamentId')->name('get_group_by_departament_id');
            Route::post('save', 'Admin\TimeTableController@save')->name('get_group_by_departament_id');
            Route::get('get_schedule_by_group_id', 'Admin\TimeTableController@getScheduleByGroupId')->name('get_schedule_by_group_id');
        });
    });
});
