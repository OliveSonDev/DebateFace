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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/start', 'DebateController@start')->name('start');
Route::post('/gostart', 'DebateController@gostart')->name('gostart');

Route::get('/join', 'DebateController@join')->name('join');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');