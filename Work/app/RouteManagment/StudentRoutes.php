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
            Route::name('save.')->prefix('save')->group(function () 
            {
                Route::post('certificate', 'Student\CertificateController@save')->name('certificate');
            });
        });
    }
}