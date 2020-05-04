<?php

namespace App\RouteManagment;

use Route;

/**
 * Класс отвечает за отправку данных о маршутах преподавателя
 */
class ApiRoutes
{
    public static function getApiRoutes()
    {
        /**
         * Методы отвечаюшие за получение данных
         */
        Route::name('getters.')->prefix('getters')->group(function () 
        {
            Route::get('users', 'Api\UserController@getUsers')->name('users'); 

            Route::get('places','Api\PlaceController@getPlaces')->name('places');

            Route::get('news/{user_id}','Api\NewsController@getNews')->name('news');

            Route::get('options', 'Api\SiteOptionsController@getSiteOptions')->name('options');

            Route::get('departments_for_combobox','Api\DepartmentController@getDepartmentsForCombobox')->name('departments_for_combobox');

            Route::get('posts','Api\PostController@getPosts')->name('posts');
            Route::get('posts_for_management','Api\PostController@getPostsForManagement')->name('posts_for_management');
            Route::get('posts_for_combobox','Api\PostController@getPostsForCombobox')->name('posts_for_combobox');
            Route::get('posts_full','Api\PostController@getPostsFull')->name('posts_full');

            Route::get('get_certificates', 'Api\CertificateController@getCertificates')->name('getCertificates');

            Route::get('get_disciplines', 'Api\DisciplineController@getDisciplines')->name('get_disciplines');
            Route::get('get_teachers', 'Api\TeacherController@getTeachers')->name('get_teachers');
            
            Route::get('get_feedback_requests', 'Api\FeedbackController@getFeedbackRequests')->name('get_feedback_requests');

            Route::get('group_by_department_id/{department_id}', 'Api\GroupController@groupByDepartmentId')->name('group_by_department_id');
            Route::get('groups_for_combobox','Api\GroupController@groupForCombobox')->name('groups_for_combobox'); 
            Route::get('groups_for_combobox_recursive','Api\GroupController@groupForComboboxRecursive')->name('groups_for_combobox_recursive'); 
            Route::get('groups','Api\GroupController@getGroups')->name('groups'); 

            Route::get('schedule_bild_by_group_id/{group_id}', 'Api\ScheduleController@getScheduleBildByGroupId')->name('schedule_bild_by_group_id');
            Route::get('schedule_by_group_id/{group_id}', 'Api\ScheduleController@getScheduleByGroupId')->name('schedule_by_group_id');

            Route::get('schedule_exams', 'Api\ScheduleExamsController@getScheduleExams')->name('schedule_exams');

            Route::get('get_call_schedule', 'Api\CallscheduleController@getCallSchedule')->name('get_call_schedule');
            Route::get('get_call_schedule_for_panel', 'Api\CallscheduleController@getCallScheduleForPanel')->name('get_call_schedule_for_panel');
            
            Route::get('replacements', 'Api\ReplacementController@getReplacements')->name('replacements');

            Route::get('notificications/{user_id}', 'Api\NotificationsController@getNotificationsForUser')->name('notificications');
        });
        /**
         * Методы отвечаюшие за добавление общих данных
         */
        Route::name('save.')->prefix('save')->group(function () {
            Route::post('replacement/{group_id}/{date}', 'Api\ReplacementController@save')->name('replacement');

            Route::post('options', 'Api\SiteOptionsController@setOptions')->name('options');

            Route::post('department','Api\DepartmentController@save')->name('department');

            Route::post('post','Api\PostController@save')->name('post');

            Route::post('group','Api\GroupController@save')->name('group');

            Route::post('schedule_exam','Api\ScheduleExamsController@save')->name('schedule_exam');
            
            Route::post('feedback','Api\FeedbackController@save')->name('feedback');

            Route::post('certificate','Api\CertificateController@save')->name('certificate');

            Route::post('news','Api\NewsController@save')->name('news');  
            
            Route::post('swap_schedule','Api\ParserController@save')->name(' swap_schedule');  

            Route::post('user','Api\UserController@save')->name('user');      

            Route::post('place','Api\PlaceController@save')->name('place');
           
            Route::post('notificications_for_user','Api\NotificationsController@saveForUser')->name('notificications_for_user');
            Route::post('notificications_for_user_group','Api\NotificationsController@saveForUserGroup')->name('notificications_for_user_group');
            Route::post('notificications_for_user_department','Api\NotificationsController@saveForUserDepartment')->name('notificications_for_user_department');
            Route::post('notificications_for_user_post','Api\NotificationsController@saveForUserPost')->name('notificications_for_user_post');
            Route::post('notificications_for_user_all','Api\NotificationsController@saveForUserAll')->name('notificications_for_user_all');
        });
        /**
         * Методы отвечаюшие за изменения общих данных
         */

        Route::name('edit.')->prefix('edit')->group(function () {
            Route::post('callschedule', 'Api\CallScheduleController@edit')->name('callschedule'); 

            Route::post('schedule/{group_id}', 'Api\ScheduleController@edit')->name('schedule');   
            
            Route::post('schedule_exam','Api\ScheduleExamsController@edit')->name('schedule_exam');

            Route::post('department','Api\DepartmentController@edit')->name('department');

            Route::post('group','Api\GroupController@edit')->name('group');

            Route::post('post','Api\PostController@edit')->name('post');

            Route::post('news','Api\NewsController@edit')->name('news');  

            Route::post('user','Api\UserController@edit')->name('user');      

            Route::post('place','Api\PlaceController@edit')->name('place');

            Route::post('notificications','Api\NotificationsController@edit')->name('notificications');
        });

         /**
         * Методы отвечаюшие за обобщенные функции
         */
        Route::name('functions.')->prefix('functions')->group(function () {
            Route::post('set_like','Api\NewsController@setLike')->name('set_like'); 

            Route::post('send_feedback_email_answer','Api\FeedbackController@sendEmail')->name('send_feedback_email_answer');

            Route::post('swap_schedule_parse','Api\ParserController@swap_schedule_parse')->name('swap_schedule_parse');
            
            Route::post('send_email_certificate_cancel','Api\CertificateController@cancel')->name('send_email_certificate_cancel');           
            Route::post('send_email_certificate_access','Api\CertificateController@access')->name('send_email_certificate_access');           
            
        });
        /**
         * Методы отвечаюшие за удаление общих данных
         */
        Route::name('delete.')->prefix('delete')->group(function () {
            Route::post('replacement/{group_id}', 'Api\ReplacementController@delete')->name('replacement');

            Route::post('schedule_exam/{id}','Api\ScheduleExamsController@delete')->name('schedule_exam');

            Route::post('department/{department_id}','Api\DepartmentController@delete')->name('department');

            Route::post('post/{post_id}','Api\PostController@delete')->name('post');

            Route::post('group/{group_id}','Api\GroupController@delete')->name('group');

            Route::post('news/{news_id}','Api\NewsController@delete')->name('news');         

            Route::post('place/{place_id}','Api\PlaceController@delete')->name('place');

            Route::post('user/{user_id}/{post_id}','Api\UserController@delete')->name('user');      
        });
    }
}