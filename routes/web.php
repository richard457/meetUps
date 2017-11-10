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

Route::post('meeting','MeetingController@store');
Route::post('agenda','AgendaController@store');
Route::post('issues','IssuesController@store');
Route::post ('invites', 'InvitesController@store');
Route::post('members','AttendaController@store');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/meeting', 'MeetingController@meeting');
Route::get('/setting', 'SettingController@setting');
Route::post('changesetting', 'SettingController@changesetting');

Route::get('/agenda/{meetingId}/{meetingtitle}', 'AgendaController@agenda');
Route::get('/issues/{meetingId}/{meetingtitle}', 'IssuesController@issues');
Route::post('upload', 'InviteByCsvFile@inviteByCsv');
Route::get ('/invites/{meetingId}/{meetingtitle}', 'InvitesController@invites');

Route::get ('/meeting/agenda/{invitingId}/{meeting_id}', 'InvitesMeetingController@meetingstatement');
Route::get ('/accept/invitation/{invitingId}/{meeting_id}', 'InvitesMeetingController@acceptInvitation');

Route::get ('/agendComment/{agendaId}/{invitedId}/{agendatitle}', 'InvitesMeetingController@singleAgenda');

Route::post ('issue_delete', 'IssuesController@issue_delete');
Route::post ('member_delete', 'AttendaController@member_delete');
Route::post ('meeting_delete', 'MeetingController@meeting_delete');
Route::post ('agenda_delete', 'AgendaController@agenda_delete');
Route::post ('editmembers', 'AttendaController@editmembers');
Route::post ('editmeeting', 'MeetingController@editmeeting');
Route::post ('editagenda', 'AgendaController@editagenda');

Route::post ('comments', 'InvitesMeetingController@store');
Route::post ('accepted', 'InvitesMeetingController@accepted');

Route::get ('/accept/invitation/{ofMettingId}', 'InvitesController@acceptInvitation');
Route::get ('/members', 'AttendaController@members');
Route::post('/more', 'HomeController@more');

//Route::post('/manipulate/','HomeController@manipulate');
