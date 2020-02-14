<?php

namespace App\RouteManagment;

use Route;

/**
 * Класс отвечает за отправку данных о маршутах cтудента
 */
class StudentRoutes
{
    public static function getApiRoutes()
    {
        Route::name('student.')->prefix('student')->group(function () 
        {
            Route::name('feedback.')->prefix('feedback')->group(function () 
            {
                Route::post('save', 'Student\FeedbackController@save')->name('save_feedback');
            });
    
            Route::name('certificate.')->prefix('certificate')->group(function () 
            {
                Route::post('save', 'Student\CertificateController@save')->name('save_certificate');
            });
        });
    }

    public static function getWebRoutes()
    {
        Route::middleware(['auth', 'access', 'profilactic'])->name('student.')->prefix('student')->group(function () {
            Route::get('/home', 'Student\HomeController@index')->name('home');
            Route::get('/news', 'WarningController@index')->name('timetable');
            Route::get('/account', 'Student\AccountController@index')->name('account');
            Route::get('/timetable', 'WarningController@index')->name('timetable');
            Route::get('/changes', 'WarningController@index')->name('changes');
            Route::get('/exams', 'WarningController@index')->name('exams');
            Route::get('/homework', 'WarningController@index')->name('homework');
            Route::get('/progress', 'WarningController@index')->name('progress');
            Route::get('/teachers', 'WarningController@index')->name('teachers');
            Route::get('/replacements', 'WarningController@index')->name('replacements');
            Route::get('/blueprints', 'WarningController@index')->name('blueprints');
            Route::get('/drivingschool', 'WarningController@index')->name('drivingschool');
            Route::get('/certificate', 'Student\CertificateController@index')->name('certificate');
            Route::get('/petition', 'WarningController@index')->name('petition');
            Route::get('/psych', 'WarningController@index')->name('psych');
            Route::get('/photos', 'WarningController@index')->name('photos');
            Route::get('/competitions', 'WarningController@index')->name('competitions');
            Route::get('/sportlife', 'WarningController@index')->name('sportlife');
            Route::get('/datastorage', 'WarningController@index')->name('datastorage');
            Route::get('/plants', 'WarningController@index')->name('plants');
            Route::get('/convocation', 'WarningController@index')->name('convocation');
            Route::get('/feedback', 'Student\FeedbackController@index')->name('feedback');
        });
    }
}
