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

Route::middleware('auth:api')->name('api.')->group(function () 
{
    //Администратор системы
    Route::name('admin.')->prefix('admin')->group(function () 
    {
        Route::post('/set_options', 'Admin\PanelControlController@setOptions')->name('set_options');

        Route::name('request_users.')->prefix('request_users')->group(function () 
        {

        });

        Route::name('callschedule.')->prefix('callschedule')->group(function () 
        {
            Route::post('edit_bildcallschedule', 'Admin\CallScheduleController@edit')->name('edit_bildcallschedule');
        });

        Route::name('user_management.')->prefix('user_management')->group(function () 
        {
            Route::get('get_users', 'Admin\UserManagementController@getUsers')->name('get_users');
            Route::post('save', 'Admin\UserManagementController@save')->name('save');
            Route::post('delete/{user_id}', 'Admin\UserManagementController@delete')->name('set_options');
            Route::post('edit/{user_id}', 'Admin\UserManagementController@edit')->name('set_options');
        });

        Route::name('place_management.')->prefix('place_management')->group(function()
        {
            Route::get('get_places','Admin\PlaceManagementController@getPlaces')->name('get_places');
            Route::post('save','Admin\PlaceManagementController@save')->name('save');
            Route::post('delete/{post_id}','Admin\PlaceManagementController@delete')->name('set_options');
            Route::post('edit/{post_id}','Admin\PlaceManagementController@edit')->name('set_options');
        });

        Route::name('department_management.')->prefix('department_management')->group(function()
        {
            Route::get('get_departments','Admin\DepartmentManagementController@getDepartments')->name('get_departments');
            Route::post('save','Admin\DepartmentManagementController@save')->name('save');
            Route::post('delete/{department_id}','Admin\DepartmentManagementController@delete')->name('set_options');
            Route::post('edit/{department_id}','Admin\DepartmentManagementController@edit')->name('set_options');
        });

        Route::name('group_management.')->prefix('group_management')->group(function()
        {
            Route::get('get_groups','Admin\GroupManagementController@getGroups')->name('get_groups');
            Route::post('save','Admin\GroupManagementController@save')->name('save');
            Route::post('delete/{group_id}','Admin\GroupManagementController@delete')->name('set_options');
            Route::post('edit/{group_id}','Admin\GroupManagementController@edit')->name('set_options');
        });

        Route::name('post_management.')->prefix('post_management')->group(function()
        {
            Route::get('get_posts','Admin\PostManagementController@getPosts')->name('get_posts');
            Route::post('save','Admin\PostManagementController@save')->name('save');
            Route::post('delete/{post_id}','Admin\PostManagementController@delete')->name('set_options');
            Route::post('edit/{post_id}','Admin\PostManagementController@edit')->name('set_options');
        });

        Route::name('retraining_management.')->prefix('retraining_management')->group(function()
        {
            Route::get('get_retrainings','Admin\RetrainingManagementController@getRetraining')->name('get_retraining');
            Route::post('save','Admin\RetrainingManagementController@save')->name('save');
            Route::post('delete/{get_retraining_id}','Admin\RetrainingManagementController@delete')->name('set_options');
            Route::post('edit/{get_retraining_id}','Admin\RetrainingManagementController@edit')->name('set_options');
        });

        Route::name('timetable.')->prefix('timetable')->group(function () 
        {
            Route::get('get_group_by_departament_id', 'Admin\TimeTableController@getGroupByDepartamentId')->name('get_group_by_departament_id');
            Route::post('edit_schedule/{group_id}', 'Admin\TimeTableController@edit')->name('edit');
            Route::get('get_schedule_bild_by_group_id/{group_id}', 'Admin\TimeTableController@getScheduleBildByGroupId')->name('get_schedule_bild_by_group_id');
            Route::get('get_schedule_by_group_id/{group_id}', 'Admin\TimeTableController@getScheduleByGroupId')->name('get_schedule_by_group_id');
            Route::get('get_group_by_departament_id/{departament_id}', 'Admin\TimeTableController@groupByDepartamentId')->name('get_group_by_departament_id');            
        });

        Route::name('replacements.')->prefix('replacements')->group(function () 
        {
            Route::get('get_group_by_departament_id', 'Admin\TimeTableController@getGroupByDepartamentId')->name('get_group_by_departament_id');
            Route::post('save', 'Admin\TimeTableController@save')->name('get_group_by_departament_id');
            Route::get('get_schedule_by_group_id', 'Admin\TimeTableController@getScheduleByGroupId')->name('get_schedule_by_group_id');
        });
    });
    //Студент
    Route::name('student.')->prefix('student')->group(function () 
    {
        Route::name('feedback.')->prefix('feedback')->group(function () 
        {
            Route::post('save', 'Student\FeedbackController@save')->name('save_feedback');
        });
    });
    //Преподаватель
    Route::name('teacher.')->prefix('teacher')->group(function () 
    {
        Route::name('feedback.')->prefix('feedback')->group(function () 
        {
            Route::post('save', 'Teacher\FeedbackController@save')->name('save_feedback');
        });
    });
    //Сотрудник учебной части
    Route::name('unit.')->prefix('unit')->group(function () 
    {
        Route::name('feedback.')->prefix('feedback')->group(function () 
        {
            Route::post('save', 'Unit\FeedbackController@save')->name('save_feedback');
        });
    });
    //Сотрудник канцелярии
    Route::name('chancellery.')->prefix('chancellery')->group(function () 
    {
        Route::name('feedback.')->prefix('feedback')->group(function () 
        {
            Route::post('save', 'Chancellery\FeedbackController@save')->name('save_feedback');
        });
    });
    //Пользователь с ограниченным функционалом
    Route::name('nullfunc.')->prefix('nullfunc')->group(function () 
    {
        Route::name('feedback.')->prefix('feedback')->group(function () 
        {
            Route::post('save', 'Nullfunc\FeedbackController@save')->name('save_feedback');
        });
    });
    //Редактор новостей
    Route::name('editor.')->prefix('editor')->group(function () 
    {
        Route::name('feedback.')->prefix('feedback')->group(function () 
        {
            Route::post('save', 'Editor\FeedbackController@save')->name('save_feedback');
        });
    });
});