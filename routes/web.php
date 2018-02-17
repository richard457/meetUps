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
Route::post('agenda','MeetingController@addAgenda');
Route::post('issues','IssuesController@store');
Route::post ('invites', 'InvitesController@store');
Route::post ('attenda', 'AttendaController@store');
Route::post ('boardupdate', 'BoardController@store');
Route::get ('board', 'BoardController@getDetails');



Route::post('members','MemberController@store');
Route::post('upload', 'InviteByCsvFile@store');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/meeting', 'MeetingController@meeting');
Route::get('/setting', 'SettingController@setting');
Route::post('changesetting', 'SettingController@changesetting');

Route::get('/_meeting/agenda/{meetingId}', 'MeetingController@agenda');
Route::get('/issues/{meetingId}/{meetingtitle}', 'IssuesController@issues');
Route::get ('/_meeting/invite/{meetingId}', 'MeetingController@invites');
Route::get ('/_meeting/list_attenda/{meetingId}', 'AttendaController@list_attenda');
Route::get ('/_meeting/new_attenda/{meetingId}', 'AttendaController@new_attenda');
Route::get ('/_meeting/board/{meetingId}', 'MeetingController@board');
Route::get ('//_meeting/reports/{meetingId}', 'MeetingController@meetingReports');


Route::get ('/meeting/agenda/{invitingId}/{meeting_id}', 'InvitesMeetingController@meetingstatement');
Route::get ('/accept/invitation/{invitingId}/{meeting_id}', 'InvitesMeetingController@acceptInvitation');

Route::get ('/agendComment/{agendaId}/{invitedId}/{agendatitle}', 'InvitesMeetingController@singleAgenda');

Route::post ('member_delete', 'MemberController@member_delete');
Route::post ('meeting_delete', 'MeetingController@meeting_delete');
Route::post ('agenda_delete', 'MeetingController@agenda_delete');
Route::post ('editmembers', 'MemberController@editmembers');
Route::post ('editmeeting', 'MeetingController@editmeeting');
Route::post ('editagenda', 'MeetingController@editagenda');
Route::post ('attenda_delete', 'AttendaController@deleteAttenda');
Route::post ('removeagendaitem', 'BoardController@removeagendaitem');
Route::post ('editagendaDetails', 'BoardController@editagendaDetails');
Route::post('finaldatachanger','MeetingController@finaldatachanger');

Route::post ('comment_delete', 'InvitesMeetingController@comment_delete');
Route::post ('_comment_delete', 'MeetingController@comment_delete');

Route::post ('comments', 'InvitesMeetingController@store');
Route::post ('accepted', 'InvitesMeetingController@accepted');

Route::get ('/accept/invitation/{ofMettingId}', 'InvitesController@acceptInvitation');
Route::get ('/members', 'MemberController@members');

Route::get ('/_meeting/{meeting_id}', 'MeetingController@meetingDetails');

Route::post('/more', 'HomeController@more');


//Route::post('/manipulate/','HomeController@manipulate');
