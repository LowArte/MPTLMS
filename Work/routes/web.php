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

Auth::routes(['register'=>false,'verify'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/feedback', 'FeedbackController@index')->name('feedback');

Route::get('/card', 'CardController@index')->name('card');

Route::get('/certificate', 'CertificateController@index')->name('certificate');

Route::get('/timetable', 'TimetableController@index')->name('timetable');

Route::get('/teachertimetable', 'TeacherTimetableController@index')->name('teachertimetable');

Route::get('/teacherhomework', 'TeacherHomeworkController@index')->name('teacherhomework');

Route::get('/contimetable', 'ConstructorTimeTableController@index')->name('contimetable');

Route::get('/conreplacements', 'ConstructorReplacementsController@index')->name('conreplacements');

Route::get('/teacheracademicperfomance', 'TeacherAcadimicPerfomanceController@index')->name('teacheracademicperfomance');

Route::get('/concallschedule', 'ConCallScheduleController@index')->name('concallschedule');
