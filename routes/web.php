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

use Illuminate\Support\Facades\Auth;
use Meet\Meeting;

Route::get('/', function () {
    return view('welcome');
});
Route::post('meeting',' @store');
Route::post('agenda/{meetingId}','AgendaController@store');
Route::post('issues/{meetingId}','IssuesController@store');
Route::post ('invites/{meetingId}', 'InvitesController@store');
Route::post('attenda','AttendaController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/agenda/{meetingId}', 'AgendaController@agenda');
Route::get('/issues/{meetingId}', 'IssuesController@issues');
Route::post('/upload', 'InviteByCsvFile@inviteByCsv');
Route::get ('/invites/{meetingId}', 'InvitesController@invites');
Route::get ('/attendees', 'AttendaController@attendees');
Route::post('/more', 'HomeController@more');

Route::post('/manipulate/','HomeController@manipulate');
