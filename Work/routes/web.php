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
Route::get('/', "AppController@index")->name('main');

Route::get('/{any}/{any2}', "AppController@index")->where("{any}",'*')->where("{any2}",'*');

Route::get('/{any}', "AppController@index")->where("{any}",'*');

Route::post('/login', "Auth\LoginController@login")->name("login");

Route::post('/getToken', "Auth\LoginController@getToken")->name("token");

Route::post('/logout', "Auth\LoginController@logout")->name("logout");

Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('password_new/{token}/{email}', 'AppController@index')->name('password.reset')->where("{token}",'*')->where("{email}",'*');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::name('api.')->prefix("api")->group(function () 
{
    Route::name('getters.')->prefix('getters')->group(function () {
        Route::get('departments','Api\DepartmentController@getDepartments')->name('departments');
    });
});

Route::get('/{vue_capture?}', function () {
    return redirect('/404');
})->where('vue_capture', '[\/\w\.-]*');

Route::post('/xerest', 'Api\DepartmentBufferController@create')->name('xerest');
