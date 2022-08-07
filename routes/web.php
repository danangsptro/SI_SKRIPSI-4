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

    Route::resource('user', 'UserController');
    
    Route::resource('room', 'RoomController');
     
    Route::resource('purpose', 'PurposeController');

    Route::resource('visit', 'VisitController');
    Route::post('visit/update-status/{id}', 'VisitController@updateStatus')->name('visit.updateStatus');

    // Profile
    Route::get('profile', 'ProfileController@index')->name('profile.index');
    Route::post('profile/update/{id}', 'ProfileController@update')->name('profile.update');
    Route::post('/profile/update-password/{id}', 'ProfileController@updatePassword')->name('profile.updatePassword');
});
