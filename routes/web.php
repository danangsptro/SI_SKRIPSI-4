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

Route::get('/', function () {
    if (!Auth::check()) {
        return view('auth.login');
    }
    return redirect(url('/dashboard'));
});
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', 'Backend\dashboardController@index')->name('dashboard');
    });
    // Ruangan
    Route::get('/ruangan', 'ruanganController@index')->name('ruangan');
    Route::get('/ruangan-create', 'ruanganController@create')->name('ruangan-create');
    Route::post('/ruangan-store', 'ruanganController@store')->name('ruangan-store');
    // Management
    Route::get('/management', 'Backend\registerController@index')->name('management');
    Route::get('/management-create', 'Backend\registerController@create')->name('management-create');
    Route::post('/management-store', 'Backend\registerController@store')->name('management-store');
    // Room/Area
    Route::get('/area', 'Backend\roomAreaController@index')->name('area');
    Route::get('/area-create', 'Backend\roomAreaController@create')->name('area-create');
    Route::post('/area-room-store', 'Backend\roomAreaController@store')->name('area-room-store');
    Route::get('/area-room-edit/{id}', 'Backend\roomAreaController@edit')->name('area-room-edit');
    Route::post('/area-room-update/{id}', 'Backend\roomAreaController@update')->name('area-room-update');
    Route::delete('/area-room/{id}', 'Backend\roomAreaController@delete')->name('area-room-delete');
    // Visit Purpose
    Route::get('/visit-purpose', 'Backend\visitPurposeController@index')->name('visit-purpose');
    Route::get('/visit-purpose-create', 'Backend\visitPurposeController@create')->name('visit-purpose-create');
    Route::post('/visit-purpose-store', 'Backend\visitPurposeController@store')->name('visit-purpose-store');
    Route::get('/visit-purpose-edit/{id}', 'Backend\visitPurposeController@edit')->name('visit-purpose-edit');
    Route::post('/visit-purpose-updae/{id}', 'Backend\visitPurposeController@update')->name('visit-purpose-update');
    Route::delete('/visit-purpose-delete/{id}', 'Backend\visitPurposeController@delete')->name('visit-purpose-delete');
});
