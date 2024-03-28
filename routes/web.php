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


Route::get('scanner/{type}/{id}','SettingController@scanner')->name('scanner');
Route::get('gates','SettingController@gates');
Route::get('classrooms','SettingController@classrooms');
Route::get('test','HomeController@send_message');
Route::post('check-user','SettingController@checkuser')->name('user');
Route::get('sync-attendances','SettingController@get_attendances');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    
Route::post('change-password/{id}','UserController@change')->name('user');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');


Route::get('teachers','TeacherController@index')->name('teachers');
Route::post('new-teacher','TeacherController@store')->name('teachers');
Route::post('edit-teacher/{id}','TeacherController@update')->name('teachers');


Route::get('students','StudentController@index')->name('students');
Route::post('new-student','StudentController@store')->name('students');
Route::post('edit-student/{id}','StudentController@update')->name('students');
Route::post('upload-avatar/{id}','StudentController@upload_image')->name('student');

Route::get('settings','SettingController@index')->name('settings');

Route::post('new-gate','GateController@store')->name('gates');
Route::post('edit-gate/{id}','GateController@update')->name('gates');


Route::post('new-room','RoomController@store')->name('room');
Route::post('edit-room/{id}','RoomController@update')->name('room');


Route::get('attendances/{type}','AttendanceController@index');




Route::get('qr-code','SettingController@qrcode')->name('qr-code');
Route::get('download-qr','SettingController@downloadQR')->name('qr-code');




Route::get('attendances','AttendanceController@index')->name('attendances');
Route::get('my-attendance','AttendanceController@myAttendance')->name('attendances');




Route::get('subjects','SubjectController@index');
Route::post('new-subject','SubjectController@store');
Route::post('edit-subject/{id}','SubjectController@update');





Route::get('schedules','ScheduleController@index');


//Print Attendance
Route::get('print-attendance/{role}/{date}','AttendanceController@attendanceReport');

});
