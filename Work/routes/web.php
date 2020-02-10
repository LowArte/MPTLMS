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

Route::get('/', "WelcomeController@index")->name("default");

Auth::routes(['register' => false, 'verify' => false,'confirm'=>false]);
//Администратор системы
Route::middleware(['profilactic','auth','access'])->name('admin.')->prefix('admin')->group(function()
{
    Route::get('/', function () {return redirect('/admin/home');})->name('home');
    Route::get('/home', 'Admin\HomeController@index')->name('home');
    Route::get('/user-crud','Admin\UserManagementController@index')->name('user-crud');
    Route::get('/panel_control','Admin\PanelControlController@index')->name('panel_control');
    Route::get('/file-crud','WarningController@index')->name('file-crud');
    Route::get('/timetable','Admin\TimetableController@index')->name('timetable');
    Route::get('/replacements','Admin\ReplacementController@index')->name('replacements');
    Route::get('/callschedule','Admin\CallScheduleController@index')->name('callschedule');
    Route::get('/department-crud','Admin\DepartmentManagementController@index')->name('departments-crud');
    Route::get('/group-crud','Admin\GroupManagementController@index')->name('groups-crud');
    Route::get('/post-crud','Admin\PostManagementController@index')->name('posts-crud');
    Route::get('/place-crud','Admin\PlaceManagementController@index')->name('place-crud');
    Route::get('/retraining-crud','Admin\RetrainingManagementController@index')->name('retraining-crud');
    Route::get('/request_users','Admin\RequestFeedbackController@index')->name('request_users');
});
//Студент
Route::middleware(['auth','access'])->name('student.')->prefix('student')->group(function()
{
    Route::get('/', function () {return redirect('/student/home');})->name('home');
    Route::get('/home', 'Student\HomeController@index')->name('home');
    Route::get('/news','WarningController@index')->name('timetable');
    Route::get('/account','Student\AccountController@index')->name('account');
    Route::get('/timetable','WarningController@index')->name('timetable');
    Route::get('/changes','WarningController@index')->name('changes');
    Route::get('/exams','WarningController@index')->name('exams');
    Route::get('/homework','WarningController@index')->name('homework');
    Route::get('/progress','WarningController@index')->name('progress');
    Route::get('/teachers','WarningController@index')->name('teachers');
    Route::get('/replacements','WarningController@index')->name('replacements');
    Route::get('/blueprints','WarningController@index')->name('blueprints');
    Route::get('/drivingschool','WarningController@index')->name('drivingschool');
    Route::get('/certificate','Student\CertificateController@index')->name('certificate');
    Route::get('/petition','WarningController@index')->name('petition');
    Route::get('/psych','WarningController@index')->name('psych');
    Route::get('/photos','WarningController@index')->name('photos');
    Route::get('/competitions','WarningController@index')->name('competitions');
    Route::get('/sportlife','WarningController@index')->name('sportlife');
    Route::get('/datastorage','WarningController@index')->name('datastorage');
    Route::get('/plants','WarningController@index')->name('plants');
    Route::get('/convocation','WarningController@index')->name('convocation');
    Route::get('/feedback','Student\FeedbackController@index')->name('feedback');
});
//Преподаватель
Route::middleware(['profilactic','auth','access'])->name('teacher.')->prefix('teacher')->group(function()
{
    Route::get('/', function () {return redirect('/teacher/home');})->name('home');
    Route::get('/home', 'Teacher\HomeController@index')->name('home');
    Route::get('/feedback','Teacher\FeedbackController@index')->name('feedback');
});
//Сотрудник учебной части
Route::middleware(['profilactic','auth','access'])->name('unit.')->prefix('unit')->group(function()
{
    Route::get('/', function () {return redirect('/unit/home');})->name('home');
    Route::get('/home', 'Unit\HomeController@index')->name('home');
    Route::get('/feedback','Unit\FeedbackController@index')->name('feedback');
});
//Сотрудник канцелярии
Route::middleware(['profilactic','auth','access'])->name('chancellery.')->prefix('chancellery')->group(function()
{
    Route::get('/', function () {return redirect('/chancellery/home');})->name('home');
    Route::get('/home', 'Chancellery\HomeController@index')->name('home');
    Route::get('/listcertificate', 'Chancellery\ListCertificateController@index')->name('list_certificate');
    Route::get('/feedback','Chancellery\FeedbackController@index')->name('feedback');
});
//Пользователь с ограниченным функционалом
Route::middleware(['profilactic','auth','access'])->name('nullfunc.')->prefix('nullfunc')->group(function()
{
    Route::get('/', function () {return redirect('/nullfunc/home');})->name('home');
    Route::get('/home', 'Nullfunc\HomeController@index')->name('home');
    Route::get('/feedback','Nullfunc\FeedbackController@index')->name('feedback');
});
//Редактор новостей
Route::middleware(['profilactic','auth','access'])->name('editor.')->prefix('editor')->group(function()
{
    Route::get('/', function () {return redirect('/editor/home');})->name('home');
    Route::get('/home', 'Editor\HomeController@index')->name('home');
    Route::get('/news','WarningController@index')->name('news');
    Route::get('/feedback','Editor\FeedbackController@index')->name('feedback');
});