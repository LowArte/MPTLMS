<?php
namespace App\RouteManagment;

use Route;

/**
 * Класс отвечает за отправку данных о маршутах преподавателя
 */
class ChancelleryRoutes
{
    public static function getApiRoutes()
    {
        Route::name('chancellery.')->prefix('chancellery')->group(function () 
        {
            Route::name('feedback.')->prefix('feedback')->group(function () 
            {
                Route::post('save', 'Chancellery\FeedbackController@save')->name('save_feedback');
            });
        });
    }

    public static function getWebRoutes()
    {
        Route::middleware(['profilactic','auth','access'])->name('chancellery.')->prefix('chancellery')->group(function()
        {
            Route::get('/home', 'Chancellery\HomeController@index')->name('home');
            Route::get('/listcertificate', 'Chancellery\ListCertificateController@index')->name('list_certificate');
            Route::get('/feedback','Chancellery\FeedbackController@index')->name('feedback');
        });
    }
}