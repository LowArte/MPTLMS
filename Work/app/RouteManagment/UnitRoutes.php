<?php
namespace App\RouteManagment;

use Route;

/**
 * Класс отвечает за отправку данных о маршутах преподавателя
 */
class UnitRoutes
{
    public static function getApiRoutes()
    {
        Route::name('unit.')->prefix('unit')->group(function () 
        {
            Route::name('feedback.')->prefix('feedback')->group(function () 
            {
                Route::post('save', 'Unit\FeedbackController@save')->name('save_feedback');
            });
        });
    }
    /**
     * Отвечает за получени маршрутных роутов
     */
    public static function getWebRoutes()
    {
        Route::middleware(['profilactic','auth','access'])->name('unit.')->prefix('unit')->group(function()
        {
            Route::get('/home', 'Unit\HomeController@index')->name('home');
            Route::get('/feedback','Unit\FeedbackController@index')->name('feedback');
        });
    }
}