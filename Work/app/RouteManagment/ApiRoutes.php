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

            Route::get('discipline_buffer','Api\DisciplineBufferController@getDisciplineBuffer')->name('discipline_buffer');
            Route::get('discipline_buffer_data/{dbName}','Api\DisciplineBufferController@getDisciplineBufferData')->name('discipline_buffer');

            Route::get('options', 'Api\SiteOptionsController@getSiteOptions')->name('options');
            Route::get('history', 'Api\HistoryController@getHistory')->name('options');

            Route::get('departments_for_combobox','Api\DepartmentController@getDepartmentsForCombobox')->name('departments_for_combobox');
            Route::get('departments','Api\DepartmentController@getDepartments')->name('departments');

            Route::get('posts','Api\PostController@getPosts')->name('posts');
            Route::get('posts_for_management','Api\PostController@getPostsForManagement')->name('posts_for_management');
            Route::get('posts_for_combobox','Api\PostController@getPostsForCombobox')->name('posts_for_combobox');
            Route::get('posts_full','Api\PostController@getPostsFull')->name('posts_full');

            Route::get('get_certificates', 'Api\CertificateController@getCertificates')->name('getCertificates');

            Route::get('get_disciplines', 'Api\DisciplineBufferController@getDisciplines')->name('get_disciplines');
            Route::get('get_teachers', 'Api\TeacherController@getTeachers')->name('get_teachers');
            
            Route::get('get_feedback_requests', 'Api\FeedbackController@getFeedbackRequests')->name('get_feedback_requests');

            Route::get('group_by_department_id/{department_id}', 'Api\GroupController@groupByDepartmentId')->name('group_by_department_id');
            Route::get('groups_for_combobox','Api\GroupController@groupForCombobox')->name('groups_for_combobox'); 
            Route::get('groups_for_combobox_recursive','Api\GroupController@groupForComboboxRecursive')->name('groups_for_combobox_recursive'); 
            Route::get('groups','Api\GroupController@getGroups')->name('groups'); 
            Route::get('groups_and_association','Api\GroupController@getGroupsAndAssociation')->name('groups_and_association'); 

            Route::get('schedule_bild_by_group_id/{group_id}', 'Api\ScheduleController@getScheduleBildByGroupId')->name('schedule_bild_by_group_id');
            Route::get('schedule_by_group_id/{group_id}', 'Api\ScheduleController@getScheduleByGroupId')->name('schedule_by_group_id');
            Route::get('schedule_teacher/{teacher_id}', 'Api\ScheduleController@getScheduleTeacher')->name('schedule_teacher');
            Route::get('schedule_bild_show_day_by_teacher_id/{teacher_id}/{day}', 'Api\ScheduleController@getScheduleBildShowDayByTeacherId')->name('schedule_bild_show_day_by_teacher_id');
            Route::get('schedule_day_teachers/{chsil}/{day}', 'Api\ScheduleController@getTeachersForScheduleDay')->name('schedule_day_teachers');

            Route::get('get_call_schedule', 'Api\CallscheduleController@getCallSchedule')->name('get_call_schedule');
            Route::get('get_call_schedule_for_panel', 'Api\CallscheduleController@getCallScheduleForPanel')->name('get_call_schedule_for_panel');
            
            Route::get('replacements', 'Api\ReplacementController@getReplacements')->name('replacements');

            Route::get('notificications/{user_id}', 'Api\NotificationsController@getNotificationsForUser')->name('notificications');
            
            Route::get('journals', 'Api\JournalController@getJournals')->name('journals');
            Route::get('journals_by_id/{journal_id}', 'Api\JournalController@getJournalsById')->name('journals_by_id');
            Route::get('journals_by_group_id/{group_id}', 'Api\JournalController@getJournalsByGroupId')->name('journals_by_group_id');

            Route::get('students_by_group_id/{group_id}', 'Api\StudentController@getStudentsByGroupId')->name('students_by_group_id');
            
            Route::get('association_for_teacher/{teacher_id}', 'Api\AssociationController@getAssociationForTeacher')->name('association_for_teacher');
            Route::get('association_teacher_discip', 'Api\AssociationController@getAssociationTeacherDiscip')->name('association_teacher_discip');

            Route::get('homework_by_teacher_id/{teacher_id}', 'Api\HomeWorkController@getHomeWorkTeacher')->name('homework_by_teacher_id');
            Route::get('homework_by_group_id/{group_id}', 'Api\AssociationHomeWorkController@getHomeWorkByGroupId')->name('homework_by_group_id');
            Route::get('homework_teacher_by_id/{home_work_id}/{user_id}', 'Api\HomeWorkController@getHomeWorkTeacherById')->name('homework_by_id');
            Route::get('homework_exam', 'Api\AssociationHomeWorkController@getHomeWorkExam')->name('homework_exam');  
        
            Route::get('homework_comment/{home_work_id}', 'Api\CommentHomeWorkController@getCommentHomeWork')->name('homework_comment'); 
            Route::get('homework_student_by_id/{home_work_id}/{group_id}/{student_id}', 'Api\AssociationHomeWorkController@getHomeWorkStudentById')->name('homework_student_by_id'); 
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

            Route::post('discipline_buffer_data/{dbName}','Api\DisciplineBufferController@save')->name('discipline_buffer_data');
            
            Route::post('feedback','Api\FeedbackController@save')->name('feedback');

            Route::post('certificate','Api\CertificateController@save')->name('certificate');

            Route::post('news','Api\NewsController@save')->name('news');  
            
            Route::post('user','Api\UserController@save')->name('user');      

            Route::post('place','Api\PlaceController@save')->name('place');

            Route::post('swap_schedule','Api\ParserController@save')->name('swap_schedule');

            Route::post('notificications_for_user','Api\NotificationsController@saveForUser')->name('notificications_for_user');
            Route::post('notificications_for_user_group','Api\NotificationsController@saveForUserGroup')->name('notificications_for_user_group');
            Route::post('notificications_for_user_department','Api\NotificationsController@saveForUserDepartment')->name('notificications_for_user_department');
            Route::post('notificications_for_user_post','Api\NotificationsController@saveForUserPost')->name('notificications_for_user_post');
            Route::post('notificications_for_user_all','Api\NotificationsController@saveForUserAll')->name('notificications_for_user_all');

            Route::post('journals', 'Api\JournalController@save')->name('journals');

            Route::post('association', 'Api\AssociationController@save')->name('association');

            Route::post('homework', 'Api\HomeWorkController@save')->name('homework');

            Route::post('homework_comment', 'Api\CommentHomeWorkController@save')->name('homework_comment');
            Route::post('load_documents_homework/{home_work_id}', 'Api\HomeWorkDocumentController@save')->name('load_documents_homework');      

            Route::post('load_homework_student_documents/{home_work_id}/{home_work_student_id}/{student_id}', 'Api\HomeWorkStudentDocumentController@save')->name('load_documents_homework');      
            
            Route::post('homework_student', 'Api\HomeWorkStudentController@save')->name('homework_student');        
        });
        /**
         * Методы отвечаюшие за изменения общих данных
         */

        Route::name('edit.')->prefix('edit')->group(function () {
            Route::post('callschedule', 'Api\CallScheduleController@edit')->name('callschedule'); 

            Route::post('schedule/{group_id}', 'Api\ScheduleController@edit')->name('schedule');   
            Route::post('schedule_classroom/', 'Api\ScheduleController@editClassroom')->name('schedule_classroom');   

            Route::post('department','Api\DepartmentController@edit')->name('department');

            Route::post('group','Api\GroupController@edit')->name('group');

            Route::post('discipline_buffer_data/{dbName}','Api\DisciplineBufferController@edit')->name('discipline_buffer_data');

            Route::post('post','Api\PostController@edit')->name('post');

            Route::post('news','Api\NewsController@edit')->name('news');  

            Route::post('user','Api\UserController@edit')->name('user');      

            Route::post('place','Api\PlaceController@edit')->name('place');

            Route::post('notificications','Api\NotificationsController@edit')->name('notificications');

            Route::post('journal_close/{journal_id}','Api\JournalController@editClose')->name('journal_close');
            Route::post('journal_close_groups/{group_id}','Api\JournalController@editCloseAll')->name('journal_close_groups');
            Route::post('journal','Api\JournalController@edit')->name('journal');
            Route::post('journal_association','Api\JournalController@editJournalAssociation')->name('journal');
            
            Route::post('homework', 'Api\HomeWorkController@edit')->name('homework');
            Route::post('homework_access', 'Api\HomeWorkController@editAccess')->name('homework_access');   
        });

         /**
         * Методы отвечаюшие за обобщенные функции
         */
        Route::name('functions.')->prefix('functions')->group(function () {
            Route::post('set_like','Api\NewsController@setLike')->name('set_like'); 

            Route::post('send_feedback_email_answer','Api\FeedbackController@sendEmail')->name('send_feedback_email_answer');
            
            Route::get('download_place_export','Api\ExportController@downloadPlaceExport')->name('download_place_export');
            Route::post('import_place','Api\ImportController@insertPlaceImport')->name('import_place');

            Route::get('download_departament_export','Api\ExportController@downloadDepartamentExport')->name('download_place_export');
            Route::post('import_departament','Api\ImportController@insertDepartamentImport')->name('import_departament');

            Route::get('download_group_export','Api\ExportController@downloadGroupExport')->name('download_group_export');
            Route::post('import_group','Api\ImportController@insertGroupImport')->name('import_group');

            Route::get('download_user_export','Api\ExportController@downloadUserExport')->name('download_user_export');
            Route::post('import_user','Api\ImportController@insertUserImport')->name('import_user');
            
            Route::post('send_email_certificate_cancel','Api\CertificateController@cancel')->name('send_email_certificate_cancel');           
            Route::post('send_email_certificate_access','Api\CertificateController@access')->name('send_email_certificate_access'); 

            Route::post('load_excel_titles','Api\JournalController@parseExcel')->name('load_excel_titles');

            Route::post('swap_schedule_parse','Api\ParserController@swap_schedule_parse')->name('swap_schedule_parse');

            Route::post('load_discipline', 'Api\DisciplineBufferController@create')->name('load_discipline');
            
            Route::get('download_document_by_id/{document_id}', 'Api\HomeWorkDocumentController@getDocument')->name('load_discipline');          
        });
        /**
         * Методы отвечающие за удаление общих данных
         */
        Route::name('delete.')->prefix('delete')->group(function () {
            Route::post('replacement/{group_id}', 'Api\ReplacementController@delete')->name('replacement');

            Route::post('department/{department_id}','Api\DepartmentController@delete')->name('department');

            Route::post('post/{post_id}','Api\PostController@delete')->name('post');

            Route::post('group/{group_id}','Api\GroupController@delete')->name('group');

            Route::post('discipline_buffer_data/{dbName}/{id}','Api\DisciplineBufferController@delete')->name('discipline_buffer_data');

            Route::post('news/{news_id}','Api\NewsController@delete')->name('news');         

            Route::post('place/{place_id}','Api\PlaceController@delete')->name('place');

            Route::post('user/{user_id}/{post_id}','Api\UserController@delete')->name('user');    
            
            Route::post('homework/{home_work_id}', 'Api\HomeWorkController@delete')->name('homework');

            Route::post('homework_document/{document_id}', 'Api\HomeWorkDocumentController@delete')->name('homework');
        });
    }
}