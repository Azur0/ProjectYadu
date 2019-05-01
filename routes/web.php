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

Route::get('/about', function () { return view('about'); });
Route::get('/contact', function () { return view('contact'); });

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/account/myevents', 'HomeController@myEvents');
Route::get('/account/participating', 'HomeController@participating');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::get('/location','API\LocationController@isWithinReach');
Route::get('events/{id}/join', 'EventsController@join');
Route::get('events/{id}/leave', 'EventsController@leave');

Route::post('/events/action', 'EventsController@action')->name('events_controller.action');
Route::post('/events/actionDistanceFilter', 'EventsController@actionDistanceFilter')->name('events_controller.actionDistanceFilter');

Auth::routes(['verify' => true]);

Route::resource('/events','EventsController');

//Profile
Route::get('profile/edit', 'ProfileController@edit')->middleware('auth');
Route::post('/profile/updateProfile', 'AccountController@updateProfile')->middleware('auth');
Route::post('/profile/changePassword', 'AccountController@changePassword')->middleware('auth');
Route::post('/profile/deleteAccount', 'AccountController@deleteAccount')->middleware('auth');

Auth::routes();

Route::get('admin', function () { return view('admin.index'); });

Route::get('admin/accounts', 'Management\AccountsController@index');
Route::get('admin/accounts/{id}', 'Management\AccountsController@show');
Route::get('admin/accounts/{id}/activate', 'Management\AccountsController@activate');
Route::get('admin/accounts/{id}/delete', 'Management\AccountsController@destroy');
Route::post('admin/accounts/{id}/update', 'Management\AccountsController@update');
Route::get('admin/accounts/{id}/avatarreset', 'Management\AccountsController@resetavatar');

Route::post('admin/accounts/action', 'Management\AccountsController@action')->name('admin_accounts_controller.action');

Route::resource('admin/events','Management\EventsController');
