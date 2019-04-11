<?php

use App\Http\Controllers\EventsController;

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

app()->singleton('ipApi', function(){
    return new \App\Services\IpApi('test');
});

Route::get('/', 'EventsController@welcome');

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () { return view('about'); });
Route::get('/contact', function () { return view('contact'); });
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
Route::get('/location','API\LocationController@isWithinReach');
Route::get('events/{id}/join', 'EventsController@join');
Route::get('events/{id}/leave', 'EventsController@leave');

Route::post('/events/action', 'EventsController@action')->name('events_controller.action');
Route::post('/events/actionDistanceFilter', 'EventsController@actionDistanceFilter')->name('events_controller.actionDistanceFilter');

Auth::routes(['verify' => true]);

//Profile
Route::get('profile/edit', 'ProfileController@edit');
Route::post('profile/edit', 'ProfileController@edit');
Route::post('/profile/updateProfile', 'AccountController@updateProfile');
Route::post('/profile/changePassword', 'AccountController@changePassword');
Route::post('/profile/deleteAccount', 'AccountController@deleteAccount');

Auth::routes();

Route::resource('events', 'EventsController');

