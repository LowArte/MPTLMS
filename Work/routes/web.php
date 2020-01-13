<?php

use App\Http\Controllers\Helpers\UserNotification;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HelpersUserNotification;

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
                "content" => "information-page-f/DrivingSchool",
                "props"   => array()
            )
        );
        UserNotification::notify("Тестовое уведомление",null,2);
        return view('welcome', ["panel_array" => json_encode($panel_array)]);
    }
);

Auth::routes(['register' => false, 'verify' => false]);

Route::get('/home', 'HomeController@index')->name('home')->name('Home');
Route::get('/feedback', 'RouteControllers\FeedbackController@index')->name('Feedback');
Route::get('/card', 'RouteControllers\CardController@index')->name('Card');
Route::get('/certificate', 'RouteControllers\CertificateController@index')->name('Certificate');
Route::get('/listcertificate', 'RouteControllers\ListCertificateController@index')->name('Listcertificate');
Route::get('/teacheracademicperfomance', 'RouteControllers\TeacherAcadimicPerfomanceController@index')->name('Teacheracademicperfomance');
Route::get('/callschedule', 'RouteControllers\CallScheduleController@index')->name('Callschedule');
Route::get('/bildcallschedule', 'RouteControllers\BildCallScheduleController@index')->name('BildCallSchedule');
Route::get('/requestsusers', 'RouteControllers\RequestsUsersController@index')->name('Requestsusers');
Route::get('/panelcontrol', 'RouteControllers\PanelControlController@index')->name('Panelcontrol');
Route::get('/usermanagement', 'RouteControllers\UserManagementController@index')->name('Usermanagement');
Route::get('/timetable', 'RouteControllers\TimetableController@index')->name('Timetable');
Route::get('/replacements', 'RouteControllers\ReplacementsController@index')->name('Replacements');
Route::get('/bildreplacements', 'RouteControllers\BildReplacementsController@index')->name('BildReplacements');
Route::get('/bildtimetable', 'RouteControllers\BildTimetableController@index')->name('BildTimetable');
Route::get('/filemanagement', 'RouteControllers\FileManagementController@index')->name('Filemanagement');

Route::post('/save_schedule', 'RouteControllers\BildTimetableController@save');
Route::post('/save_user', 'RouteControllers\UserManagementController@saveUser');
Route::post('/delete_user', 'RouteControllers\UserManagementController@deleteUser');
Route::post('/save_file', 'RouteControllers\FileManagementController@saveFile');
Route::post('/delete_file', 'RouteControllers\FileManagementController@deleteFile');
Route::post('/delete_replacement', 'RouteControllers\ReplacementsController@deleteReplacement');
Route::post('/send_email', 'RouteControllers\RequestsUsersController@sendEmail');
Route::post('/save_feedback', 'RouteControllers\FeedbackController@savefeedback');
Route::post('/save_bildcallschedule', 'RouteControllers\BildCallScheduleController@save');
Route::post('/save_certificate', 'RouteControllers\CertificateController@saveCertificate');
Route::post('/set_options', 'RouteControllers\PanelControlController@setConfigOptions');
Route::post('/setNotificationAsRead', 'LoggedUserController@setNotificationAsRead');
Route::post('/save_replacement', 'RouteControllers\BildReplacementsController@save');

Route::get('/get_file', 'RouteControllers\FileManagementController@getFile');
Route::get('/detailedir', 'RouteControllers\DetailedInfoIrmationRetrainingController@index')->name('detailedir');
Route::get('/get_users', 'RouteControllers\UserManagementController@getUsers');
Route::get('/get_files', 'RouteControllers\FileManagementController@getFiles');
Route::get('/get_group_by_departament_id', 'RouteControllers\TimetableController@groupByDepartamentId');
Route::get('/get_schedule_by_group_id', 'RouteControllers\TimetableController@scheduleByGroupId');
Route::get('/get_schedule_by_day', 'RouteControllers\TimetableController@scheduleByDay');
Route::get('/get_bild_schedule_by_group_id', 'RouteControllers\BildTimetableController@scheduleByGroupId');
Route::get('/get_all_replacements', 'RouteControllers\ReplacementsController@getAllReplacements');
Route::get('/get_replacements_by_group_id_by_date', 'RouteControllers\ReplacementsController@getReplacements');
Route::get('/get_all_replacements_by_group', 'RouteControllers\ReplacementsController@getAllReplacementsByGroup');
Route::get('/get_all_replacements_by_date', 'RouteControllers\ReplacementsController@getAllReplacementsByDate');
Route::get('/download_file', 'LoggedUserController@downloadFile');
