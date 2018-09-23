<?php

use Illuminate\Http\Request;

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

Route::get('/postAsset', 'APIController@postAsset');
Route::post('/postAsset', 'APIController@postAsset');
Route::get('/unapproved','APIController@unapprovedUsers');
Route::post('/unapproved','APIController@unapprovedUsers');
Route::get('/userlist','APIController@userList');
Route::post('/userlist','APIController@userList');
Route::get('/setUser','APIController@setUser');
Route::post('/setUser','APIController@setUser');
Route::get('/postUser','APIController@postUser');
Route::post('/postUser','APIController@postUser');
Route::get('/getFrom','APIController@reqFromDep');
Route::post('/getFrom','APIController@reqFromDep');
Route::get('/getTo','APIController@reqToDep');
Route::post('/getTo','APIController@reqToDep');

