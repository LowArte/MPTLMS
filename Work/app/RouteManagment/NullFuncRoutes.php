<?php
namespace App\RouteManagment;

use Route;

/**
 * Класс отвечает за отправку данных о маршутах преподавателя
 */
class NullFuncRoutes
{
    public static function getApiRoutes()
    {
        Route::name('nullfunc.')->prefix('nullfunc')->group(function () 
        {
            Route::name('feedback.')->prefix('feedback')->group(function () 
            {
                Route::post('save', 'Nullfunc\FeedbackController@save')->name('save_feedback');
            });
        });
    }
    /**
     * Отвечает за получени маршрутных роутов
     */
    public static function getWebRoutes()
    {
        Route::middleware(['profilactic','auth','access'])->name('nullfunc.')->prefix('nullfunc')->group(function()
        {
            Route::get('/', function () {return redirect('/nullfunc/home');})->name('home');
            Route::get('/home', 'Nullfunc\HomeController@index')->name('home');
            Route::get('/feedback','Nullfunc\FeedbackController@index')->name('feedback');
        });
    }
}