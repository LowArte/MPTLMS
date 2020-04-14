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

            Route::get('news','Api\NewsController@getNews')->name('news');

            Route::get('options', 'Api\SiteOptionsController@getSiteOptions')->name('options');

            Route::get('departments_for_combobox','Api\DepartamentController@getDepartmentsForCombobox')->name('departments_for_combobox');

            Route::get('posts','Api\PostController@getPosts')->name('posts');
            Route::get('posts_for_management','Api\PostController@getPostsForManagement')->name('posts_for_management');
            Route::get('posts_for_combobox','Api\PostController@getPostsForCombobox')->name('posts_for_combobox');

            Route::get('retrainings','Api\RetrainingController@getRetraining')->name('retrainings');

            Route::get('get_certificates', 'Api\CertificateController@getCertificates')->name('getCertificates');

            Route::get('get_disciplines', 'Api\DisciplineController@getDisciplines')->name('get_disciplines');
            Route::get('get_teachers', 'Api\TeacherController@getTeachers')->name('get_teachers');
            
            Route::get('get_feedback_requests', 'Api\FeedbackController@getFeedbackRequests')->name('get_feedback_requests');

            Route::get('group_by_departament_id/{departament_id}', 'Api\GroupController@groupByDepartamentId')->name('group_by_departament_id');
            Route::get('groups_for_combobox','Api\GroupController@groupForCombobox')->name('groups_for_combobox'); 
            Route::get('groups','Api\GroupController@getGroups')->name('groups'); 

            Route::get('schedule_bild_by_group_id/{group_id}', 'Api\ScheduleController@getScheduleBildByGroupId')->name('schedule_bild_by_group_id');
            Route::get('schedule_by_group_id/{group_id}', 'Api\ScheduleController@getScheduleByGroupId')->name('schedule_by_group_id');

            Route::get('get_call_schedule', 'Api\CallscheduleController@getCallSchedule')->name('get_call_schedule');
            Route::get('get_call_schedule_for_panel', 'Api\CallscheduleController@getCallScheduleForPanel')->name('get_call_schedule_for_panel');
            
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

            Route::post('options', 'Api\SiteOptionsController@setOptions')->name('options');

            Route::post('departament','Api\DepartamentController@save')->name('departament');
            Route::post('feedback','Api\FeedbackController@save')->name('feedback');

            Route::get('news','Api\NewsController@save')->name('news');              

            Route::post('place','Api\PlaceController@save')->name('place');

        });
        /**
         * Методы отвечаюшие за изменения общих данных
         */

        Route::name('edit.')->prefix('edit')->group(function () {
            Route::post('callschedule', 'Api\CallScheduleController@edit')->name('callschedule'); 

            Route::post('schedule/{group_id}', 'Api\ScheduleController@edit')->name('schedule');    

            Route::post('departament','Api\DepartamentController@edit')->name('departament');

            Route::get('news','Api\NewsController@edit')->name('news'); 
            Route::get('setLike/{post_id}','Api\NewsController@setLike')->name('add_like');           

            Route::post('place','Api\PlaceController@edit')->name('place');

        });
        /**
         * Методы отвечаюшие за удаление общих данных
         */
        Route::name('delete.')->prefix('delete')->group(function () {
            Route::post('replacement/{group_id}', 'Api\ReplacementController@delete')->name('replacement');

            Route::post('departament/{departament_id}','Api\DepartamentController@delete')->name('departament');

            Route::get('news/{news_id}','Api\NewsController@delete')->name('news');         

            Route::post('place/{place_id}','Api\PlaceController@delete')->name('place');

        });
    }
}