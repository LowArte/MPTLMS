<?php
namespace App\RouteManagment;

use Route;

/**
 * Класс отвечает за отправку данных о маршутах администратора
 */
class AdminRoutes
{
    public static function getApiRoutes()
    {
        Route::name('admin.')->prefix('admin')->group(function () 
        {
            Route::name('options.')->prefix('options')->group(function () 
            {
                Route::post('/set_options', 'Admin\PanelControlController@setOptions')->name('set_options');
            });

            Route::name('request_users.')->prefix('request_users')->group(function () 
            {
                Route::post('send_email', 'Admin\RequestFeedbackController@sendEmail')->name('send_email');
            });
    
            Route::name('user_management.')->prefix('user_management')->group(function () 
            {
                Route::post('save', 'Admin\UserManagementController@save')->name('save');
                Route::post('delete/{user_id}', 'Admin\UserManagementController@delete')->name('set_options');
                Route::post('edit/{user_id}', 'Admin\UserManagementController@edit')->name('set_options');
            });
    
            Route::name('place_management.')->prefix('place_management')->group(function()
            {
                Route::post('save','Admin\PlaceManagementController@save')->name('save');
                Route::post('delete/{post_id}','Admin\PlaceManagementController@delete')->name('set_options');
                Route::post('edit/{post_id}','Admin\PlaceManagementController@edit')->name('set_options');
            });
    
            Route::name('department_management.')->prefix('department_management')->group(function()
            {
                Route::post('save','Admin\DepartmentManagementController@save')->name('save');
                Route::post('delete/{department_id}','Admin\DepartmentManagementController@delete')->name('set_options');
                Route::post('edit/{department_id}','Admin\DepartmentManagementController@edit')->name('set_options');
            });
    
            Route::name('group_management.')->prefix('group_management')->group(function()
            {
                Route::post('save','Admin\GroupManagementController@save')->name('save');
                Route::post('delete/{group_id}','Admin\GroupManagementController@delete')->name('set_options');
                Route::post('edit/{group_id}','Admin\GroupManagementController@edit')->name('set_options');
            });
    
            Route::name('post_management.')->prefix('post_management')->group(function()
            {
                Route::post('save','Admin\PostManagementController@save')->name('save');
                Route::post('delete/{post_id}','Admin\PostManagementController@delete')->name('set_options');
                Route::post('edit/{post_id}','Admin\PostManagementController@edit')->name('set_options');
            });
    
            Route::name('retraining_management.')->prefix('retraining_management')->group(function()
            {
                Route::post('save','Admin\RetrainingManagementController@save')->name('save');
                Route::post('delete/{get_retraining_id}','Admin\RetrainingManagementController@delete')->name('set_options');
                Route::post('edit/{get_retraining_id}','Admin\RetrainingManagementController@edit')->name('set_options');
            });
        });
    }
    /**
     * Отвечает за получени маршрутных роутов
     */
    public static function getWebRoutes()
    {
        Route::middleware(['auth','access','profilactic'])->name('admin.')->prefix('admin')->group(function()
        {
            Route::get('/home', 'Admin\HomeController@index')->name('home');
            Route::get('/user-crud','Admin\UserManagementController@index')->name('user-crud');
            Route::get('/panel_control','Admin\PanelControlController@index')->name('panel_control');
            Route::get('/file-crud','WarningController@index')->name('file-crud');
            Route::get('/timetable','Admin\TimetableController@index')->name('timetable');
            Route::get('/replacements','Admin\ReplacementController@index')->name('replacements');
            Route::get('/callschedule','Admin\CallScheduleController@index')->name('callschedule');
            Route::get('/department-crud','Admin\DepartmentManagementController@index')->name('departments-crud');
            Route::get('/group-crud','Admin\GroupManagementController@index')->name('groups-crud');
            Route::get('/post-crud','Admin\PostManagementController@index')->name('posts-crud');
            Route::get('/place-crud','Admin\PlaceManagementController@index')->name('place-crud');
            Route::get('/retraining-crud','Admin\RetrainingManagementController@index')->name('retraining-crud');
            Route::get('/request_users','Admin\RequestFeedbackController@index')->name('request_users');
        });
    }
}