<?php
use Illuminate\Support\Facades\Auth;

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
Route::get('/concallschedule', 'RouteControllers\BildCallScheduleController@index')->name('BildCallSchedule');
Route::get('/requestsusers', 'RouteControllers\RequestsUsersController@index')->name('Requestsusers');
Route::get('/panelcontrol', 'RouteControllers\PanelControlController@index')->name('Panelcontrol');
Route::get('/usermanagement', 'RouteControllers\UserManagementController@index')->name('usermanagement');
Route::get('/timetable', 'RouteControllers\TimetableController@index')->name('timetable');


Route::post('/save_user', 'RouteControllers\UserManagementController@saveUser');
Route::post('/delete_user', 'RouteControllers\UserManagementController@deleteUser');
Route::post('/send_email', 'RouteControllers\RequestsUsersController@sendEmail');
Route::post('/save_feedback', 'RouteControllers\FeedbackController@savefeedback');
Route::post('/save_concallschedule', 'RouteControllers\BildCallScheduleController@save');
Route::post('/save_certificate', 'RouteControllers\CertificateController@saveCertificate');

Route::post('/save_schedule', 'RouteControllers\ConstructorTimeTableController@save');
Route::post('/set_options', 'RouteControllers\PanelControlController@setConfigOptions');
Route::post('/setNotificationAsRead', 'LoggedUserController@setNotificationAsRead');

Route::get('/detailedir', 'RouteControllers\DetailedInfoIrmationRetrainingController@index')->name('detailedir');
Route::get('/get_users', 'RouteControllers\UserManagementController@getUsers');
Route::get('/get_group_by_departament_id', 'RouteControllers\TimetableController@groupByDepartamentId');
Route::get('/get_schedule_by_group_id', 'RouteControllers\TimetableController@scheduleByGroupId');