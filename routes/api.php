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
Route::get('/reqFromDep','APIController@reqFromDep');
Route::post('/reqFromDep','APIController@reqFromDep');
Route::get('/reqToDep','APIController@reqToDep');
Route::post('/reqToDep','APIController@reqToDep');
Route::get('/userDetail','APIControllser@userDetail');
Route::post('/userDetail','APIController@userDetail');
Route::get('/reqToStaff','APIController@reqToStaff');
Route::post('/reqToStaff','APIController@reqToStaff');
Route::get('/reqFromStaff','APIController@reqFromStaff');
Route::post('/reqFromStaff','APIController@reqFromStaff');
Route::get('/assetOwned','APIController@assetOwned');
Route::post('/assetOwned','APIController@assetOwned');
Route::get('/getAssets', 'APIController@getAssets');
Route::get('/approveRequest', 'APIController@approveRequest');


