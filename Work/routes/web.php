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
Route::get('/', "AppController@index")->name("default");

Route::get('/{any}/{any2}', "AppController@index")->name("any")->where("{any}",'*')->where("{any2}",'*');

Route::get('/{any}', "AppController@index")->name("any")->where("{any}",'*');

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