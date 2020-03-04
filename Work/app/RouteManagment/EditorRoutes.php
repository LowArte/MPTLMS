<?php
namespace App\RouteManagment;

use Route;

/**
 * Класс отвечает за отправку данных о маршутах преподавателя
 */
class EditorRoutes
{
    public static function getApiRoutes()
    {
        Route::name('editor.')->prefix('editor')->group(function () 
        {
            Route::name('feedback.')->prefix('feedback')->group(function () 
            {
                Route::post('save', 'Editor\FeedbackController@save')->name('save_feedback');
            });
        });
    }
    /**
     * Отвечает за получени маршрутных роутов
     */
    public static function getWebRoutes()
    {
        Route::middleware(['profilactic','auth','access'])->name('editor.')->prefix('editor')->group(function()
        {
            Route::get('/', function () {return redirect('/editor/home');})->name('home');
            Route::get('/home', 'Editor\HomeController@index')->name('home');
            Route::get('/news','WarningController@index')->name('news');
            Route::get('/news-constructor','Editor\NewsConstructorController@index')->name('newsconstructor');
            Route::get('/feedback','Editor\FeedbackController@index')->name('feedback');
        });
    }
}