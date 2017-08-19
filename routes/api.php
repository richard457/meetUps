<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Meet\Meeting;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/meetings', function (Request $request) {
    return Meeting::whereuser_id(Auth::id())->get();
});
