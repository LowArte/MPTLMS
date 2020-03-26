<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\RouteManagment\AdminRoutes;
use App\RouteManagment\ChancelleryRoutes;
use App\RouteManagment\EditorRoutes;
use App\RouteManagment\NullFuncRoutes;
use App\RouteManagment\StudentRoutes;
use App\RouteManagment\TeacherRoutes;
use App\RouteManagment\UnitRoutes;

//Default page
Route::get('/', "WelcomeController@index")->name("default");

Route::get('/admin/{any}', "SystemController@index")->name("admin.any")->where("{any}",'*');
Route::get('/admin', "SystemController@index")->name("admin");

Route::get('/{any}', "WelcomeController@index")->name("default")->where("{any}",'*');

Route::post('/login', "Auth\LoginController@login")->name("login");
Route::post('/getToken', "Auth\LoginController@getToken")->name("token");


//Маршруты авторизации

// Auth::routes(['register' => false, 'verify' => false,'confirm'=>false]);
//Администратор системы
// AdminRoutes::getWebRoutes();
// //Студент
// StudentRoutes::getWebRoutes();
// //Преподаватель
// TeacherRoutes::getWebRoutes();
// //Сотрудник учебной части
// UnitRoutes::getWebRoutes();
// //Сотрудник канцелярии
// ChancelleryRoutes::getWebRoutes();
// //Пользователь с ограниченным функционалом
// NullFuncRoutes::getWebRoutes();
// //Редактор новостей
// EditorRoutes::getWebRoutes();