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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('init', 'Auth\AuthController@init');

    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
});

Route::prefix('schedule')->group(function () {
    Route::get('get_schedule', 'Schedule\Schedule@get_schedule');

    Route::post('save', 'Schedule\Schedule@save');
});

Route::prefix('get_data')->group(function () {
    Route::get('get_all_groups', 'Getter\Getters@get_all_groups');
    Route::get('get_groups_by_departament', 'Getter\Getters@get_groups_by_departament');
    Route::get('get_all_departaments', 'Getter\Getters@get_all_departaments');
});
