<?php

namespace App\RouteManagment;

use Route;

/**
 * Класс отвечает за отправку данных о маршутах преподавателя
 */
class ApiRoutes
{
    //!! Поменять контроллеры
    public static function getApiRoutes()
    {
        /**
         * Методы отвечаюшие за получение общих данных
         */
        Route::name('getters.')->prefix('getters')->group(function () {
            Route::get('users', 'Api\UserController@getUsers')->name('users'); 

            Route::get('places','Api\PlaceController@getPlaces')->name('places');

            Route::get('departments','Api\DepartamentController@getDepartments')->name('departments');
            Route::get('departments_for_combobox','Api\DepartamentController@getDepartmentsForCombobox')->name('departments_for_combobox');

            Route::get('posts','Api\PostController@getPosts')->name('posts');
            Route::get('posts_for_management','Api\PostController@getPostsForManagement')->name('posts_for_management');

            Route::get('retrainings','Api\RetrainingController@getRetraining')->name('retrainings');

            Route::get('get_certificates', 'Api\CertificateController@getCertificates')->name('getCertificates');
            
            Route::get('get_feedback_requests', 'Api\FeedbackController@getFeedbackRequests')->name('get_feedback_requests');

            Route::get('group_by_departament_id/{departament_id}', 'Api\GroupController@groupByDepartamentId')->name('group_by_departament_id');
            Route::get('groups','Api\GroupController@getGroups')->name('groups'); 

            Route::get('schedule_bild_by_group_id/{group_id}', 'Api\ScheduleController@getScheduleBildByGroupId')->name('schedule_bild_by_group_id');
            Route::get('schedule_by_group_id/{group_id}', 'Api\ScheduleController@getScheduleByGroupId')->name('schedule_by_group_id');
            
            Route::get('replacements', 'Api\ReplacementController@replacements')->name('replacements');
            Route::get('replacements_by_group/{group_id}', 'Api\ReplacementController@replacementsByGroup')->name('replacements_by_group');
            Route::get('replacements_by_date/{date}', 'Api\ReplacementController@replacementsByDate')->name('replacements_by_date');
            Route::get('replacements_by_group_by_date/{group_id}/{date}', 'Api\ReplacementController@replacementsByGroupByDate')->name('replacements_by_group_by_date');
        });
        /**
         * Методы отвечаюшие за добавление общих данных
         */
        Route::name('save.')->prefix('save')->group(function () {
            Route::post('replacement/{group_id}/{date}', 'Api\ReplacementController@save')->name('replacement');
        });
        /**
         * Методы отвечаюшие за изменения общих данных
         */

        Route::name('edit.')->prefix('edit')->group(function () {
            Route::post('callschedule', 'Api\CallScheduleController@edit')->name('callschedule'); 

            Route::post('schedule/{group_id}', 'Api\ScheduleController@edit')->name('schedule');    
        });
        /**
         * Методы отвечаюшие за удаление общих данных
         */
        Route::name('delete.')->prefix('delete')->group(function () {
            Route::post('replacement/{group_id}', 'Api\ReplacementController@delete')->name('replacement');
        });
    }
}