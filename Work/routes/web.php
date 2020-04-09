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


//Default page
Route::get('/', "AppController@index");

Route::get('/{any}/{any2}', "AppController@index")->where("{any}",'*')->where("{any2}",'*');

Route::get('/{any}', "AppController@index")->where("{any}",'*');

Route::post('/login', "Auth\LoginController@login")->name("login");

Route::post('/getToken', "Auth\LoginController@getToken")->name("token");

Route::post('/logout', "Auth\LoginController@logout")->name("logout");

Route::name('api.')->prefix("api")->group(function () 
{
    Route::name('getters.')->prefix('getters')->group(function () {
        Route::get('departments','Api\DepartamentController@getDepartments')->name('departments');
    });
});