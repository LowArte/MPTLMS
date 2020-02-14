<?php

use App\RouteManagment\AdminRoutes;
use App\RouteManagment\ApiRoutes;
use App\RouteManagment\ChancelleryRoutes;
use App\RouteManagment\EditorRoutes;
use App\RouteManagment\NullFuncRoutes;
use App\RouteManagment\StudentRoutes;
use App\RouteManagment\TeacherRoutes;
use App\RouteManagment\UnitRoutes;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->name('api.')->group(function () 
{
    //Общий функционал
    ApiRoutes::getApiRoutes();
    //Администратор системы
    AdminRoutes::getApiRoutes();
    //Студент
    StudentRoutes::getApiRoutes();
    //Преподаватель
    TeacherRoutes::getApiRoutes();
    //Сотрудник учебной части
    UnitRoutes::getApiRoutes();
    //Сотрудник канцелярии
    ChancelleryRoutes::getApiRoutes();
    //Пользователь с ограниченным функционалом
    NullFuncRoutes::getApiRoutes();
    //Редактор новостей
    EditorRoutes::getApiRoutes();
});