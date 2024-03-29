<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Utility
    Route::get('get-notif-visit', 'HomeController@getNotifVisit')->name('getNotifVisit');

    // User
    Route::resource('user', 'UserController');

    // Room
    Route::resource('room', 'RoomController');
     
    // Purpose
    Route::resource('purpose', 'PurposeController');

    // Visit
    Route::resource('visit', 'VisitController');
    Route::post('visit/update-status/{id}', 'VisitController@updateStatus')->name('visit.updateStatus');
    Route::get('visit/cetak-pdf/{id}', 'VisitController@cetakPDF')->name('visit.cetakPDF');
    Route::get('visit/selesai-visit/{id}', 'VisitController@visitSelesai')->name('visit.selesaiVisit');

    // Profile
    Route::get('profile', 'ProfileController@index')->name('profile.index');
    Route::post('profile/update/{id}', 'ProfileController@update')->name('profile.update');
    Route::post('/profile/update-password/{id}', 'ProfileController@updatePassword')->name('profile.updatePassword');

    // Report
    Route::get('report', 'ReportController@index')->name('report.index');
    Route::get('report/cetak-pdf', 'ReportController@cetakPDF')->name('report.cetakPDF');
});
