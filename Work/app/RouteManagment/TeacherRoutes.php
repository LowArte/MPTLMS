<?php
namespace App\RouteManagment;

use Route;

/**
 * Класс отвечает за отправку данных о маршутах преподавателя
 */
class TeacherRoutes
{
    public static function getApiRoutes()
    {
        Route::name('teacher.')->prefix('teacher')->group(function () 
        {
            Route::name('feedback.')->prefix('feedback')->group(function () 
            {
                Route::post('save', 'Teacher\FeedbackController@save')->name('save_feedback');
            });
        });
    }
    /**
     * Отвечает за получени маршрутных роутов
     */
    public static function getWebRoutes()
    {
        Route::middleware(['profilactic','auth','access'])->name('teacher.')->prefix('teacher')->group(function()
        {
            Route::get('/home', 'Teacher\HomeController@index')->name('home');
            Route::get('/feedback','Teacher\FeedbackController@index')->name('feedback');
        });
    }
}