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

Route::get('/debate/{id}', 'DebateController@debate')->name('debate');
Route::get('/debate/{id}/{password}', 'DebateController@debate')->name('debate');

// Get User Name of Debator
Route::post('/getusername', 'DebateController@getUserName')->name('getusername');

//Check role and Watch / Join
Route::post('/goforjoin', 'DebateController@goForJoin')->name('goforjoin');

// Get Admin Key
Route::post('/getadminkey', 'DebateController@getAdminKey')->name('getadminkey');

// Remove debator ID in a debate
Route::post('/kick', 'DebateController@kickDebator')->name('kick');

// Save timelimit value for a debator 
Route::post('/timelimit', 'DebateController@saveTimer')->name('timelimit');

// Add a feeling for a debator 
Route::post('/feeling', 'DebateController@addFeeling')->name('feeling');