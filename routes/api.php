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

Route::get('events/{event}/messages', 'MessageController@index');

Route::middleware('auth:api')->group(function () {
    Route::post('events/{event}/message', 'MessageController@store');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
