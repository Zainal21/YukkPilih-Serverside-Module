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


// user authentication
Route::get('/', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@handleLogin')->name('action.login');
Route::get('/logout', 'AuthController@handleLogout')->name('handleLogout');
// reset password
Route::get('/reset', 'AuthController@reset')->name('reset');
Route::post('/reset', 'AuthController@handleresetpassword');

// get poll
Route::get('poll', 'PollController@index')->name('poll.index');
// create and delete polling
Route::post('poll', 'PollController@store')->name('poll.store');
Route::delete('poll/{id}', 'PollController@destroy')->name('poll.destroy');
// user vote
Route::post('poll/{poll_id}/vote/{choices_id}', 'VoteController@vote')->name('vote');