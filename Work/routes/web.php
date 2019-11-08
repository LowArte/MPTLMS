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

Route::get(
    '/',
    function () {
        $panel_array = array(
            array(
                "header"  => "Подробная информация",
                "content" => "mainpage/MainPageComponent",
                "props"   => array()
            )
        );
        return view('welcome', ["panel_array" => json_encode($panel_array)]);
    }
);

Auth::routes(['register' => false, 'verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/feedback', 'RouteControllers\FeedbackController@index')->name('feedback');

Route::get('/card', 'RouteControllers\CardController@index')->name('card');

Route::get('/certificate', 'RouteControllers\CertificateController@index')->name('certificate');

Route::get('/timetable', 'RouteControllers\TimetableController@index')->name('timetable');

Route::get('/teachertimetable', 'RouteControllers\TeacherTimetableController@index')->name('teachertimetable');

Route::get('/teacherhomework', 'RouteControllers\TeacherHomeworkController@index')->name('teacherhomework');

Route::get('/contimetable', 'RouteControllers\ConstructorTimeTableController@index')->name('contimetable');

Route::get('/conreplacements', 'RouteControllers\ConstructorReplacementsController@index')->name('conreplacements');

Route::get('/teacheracademicperfomance', 'RouteControllers\TeacherAcadimicPerfomanceController@index')->name('teacheracademicperfomance');

Route::get('/concallschedule', 'RouteControllers\ConCallScheduleController@index')->name('concallschedule');

Route::get('/callschedule', 'RouteControllers\ConCallScheduleController@index2')->name('callschedule');

Route::get('/requestsusers', 'RouteControllers\RequestsUsersController@index')->name('requestsusers');

Route::get('/panelcontrol', 'RouteControllers\PanelControlController@index')->name('panelcontrol');

Route::post('/save_concallschedule', 'RouteControllers\ConCallScheduleController@save');

Route::post('/get_group_by_departament_id', 'RouteControllers\TimeTableController@groupByDepartamentId');


