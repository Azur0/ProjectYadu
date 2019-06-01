<?php

use App\Http\Controllers\EventsController;
use App\socialmedia;

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
Route::get('/cookies', function () { return view('cookies'); });
Route::get('/privacy', function () { return view('privacy'); });
Route::get('/terms', function () { return view('terms'); });
Route::get('/contact', function () { $socialmedia = socialmedia::all(); return view('contact', compact('socialmedia')); });

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/account/myevents', 'HomeController@myEvents')->middleware('auth');
Route::get('/account/participating', 'HomeController@participating')->middleware('auth');
Route::get('/account/{id}/profile/{contentType}', 'AccountController@profileInfo')->middleware('auth');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::get('/location','API\LocationController@isWithinReach');
Route::get('events/{id}/join', 'EventsController@join');
Route::get('events/{id}/leave', 'EventsController@leave');

Route::post('/events/action', 'EventsController@action')->name('events_controller.action');
Route::post('/events/actionDistanceFilter', 'EventsController@actionDistanceFilter')->name('events_controller.actionDistanceFilter');

Auth::routes(['verify' => true]);

//Profile
//Why edit an not update
Route::get('/profile/edit', 'AccountController@edit')->middleware('auth');
//Extra
Route::patch('/profile/updateAccountSettings/{id}', 'AccountController@updateSettings')->middleware('auth');
Route::post('/profile/updatePrivacySettings', 'AccountController@updatePrivacySettings')->middleware('auth');
Route::post('/profile/updateProfile', 'AccountController@updateProfile')->middleware('auth');

Route::get('/profile/{id}/follow', 'AccountController@follow')->middleware('auth');
Route::get('/profile/{id}/accept', 'AccountController@accept')->middleware('auth');
Route::get('/profile/{id}/decline', 'AccountController@decline')->middleware('auth');
Route::get('/profile/{id}/unfollow', 'AccountController@unfollow')->middleware('auth');
Route::post('/profile/changePassword', 'AccountController@changePassword')->middleware('auth');
Route::post('/profile/deleteAccount', 'AccountController@deleteAccount')->middleware('auth');
Route::post('/profile/blockUser', 'AccountController@blockAccount')->middleware('auth');
Route::post('/profile/unblockUser/', 'AccountController@unblockAccount')->middleware('auth');

Auth::routes();

Route::resource('events', 'EventsController');

Route::get('admin', function () { return view('admin.index');})->middleware('auth', 'isAdmin');

Route::post('/language', 'LanguageController@setLanguage');

// Admin accounts
//CRUD
Route::get('admin/accounts', 'Admin\AccountsController@index')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}', 'Admin\AccountsController@show')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}/delete', 'Admin\AccountsController@destroy')->middleware('auth', 'isAdmin');
Route::post('admin/accounts/{id}/update', 'Admin\AccountsController@update')->middleware('auth', 'isAdmin');
//Extra
Route::get('admin/accounts/{id}/activate', 'Admin\AccountsController@activate')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}/avatarreset', 'Admin\AccountsController@resetavatar')->middleware('auth', 'isAdmin');
Route::post('admin/accounts/action', 'Admin\AccountsController@action')->name('admin_accounts_controller.action');

//Admin events
Route::resource('admin/events','Admin\EventsController');
Route::post('/admin/events/actionDistanceFilter', 'Admin\EventsController@actionDistanceFilter')->name('admin_events_controller.actionDistanceFilter');

//Admin prohibitedWords
Route::resource('admin/swearWords','Admin\ProhibitedWordsController');
//CRUD -> why /\ this if use this \/
Route::get('admin/prohibitedWords', 'Admin\ProhibitedWordsController@index')->middleware('auth', 'isAdmin');
Route::post('admin/prohibitedWords/delete', 'Admin\ProhibitedWordsController@destroy')->middleware('auth', 'isAdmin');
Route::post('admin/prohibitedWords/update', 'Admin\ProhibitedWordsController@update')->middleware('auth', 'isAdmin');
Route::post('admin/prohibitedWords/create', 'Admin\ProhibitedWordsController@create')->middleware('auth', 'isAdmin');

//Admin logger
Route::post('/logger/eventshared', 'LogController@LogEventShared')->name('LogEventShared');

//Admin charts
Route::post('/charts/totaleventscreated', 'Admin\ChartController@GetTotalEventsCreated')->name('admin_charts_events')->middleware('auth', 'isAdmin');
Route::post('/charts/shares', 'Admin\ChartController@GetShares')->name('admin_charts_shares')->middleware('auth', 'isAdmin');
Route::post('/charts/activeeventlocations', 'Admin\ChartController@GetActiveEventLocations')->name('admin_charts_locations')->middleware('auth', 'isAdmin');
Route::post('/charts/categories', 'Admin\ChartController@GetCategories')->name('admin_charts_categories')->middleware('auth', 'isAdmin');
Route::post('/charts/chatmessages', 'Admin\ChartController@GetChatmessages')->name('admin_charts_chatmessages')->middleware('auth', 'isAdmin');
Route::post('/charts/accountscreated', 'Admin\ChartController@GetAccountsCreated')->name('admin_charts_accounts_created')->middleware('auth', 'isAdmin');
Route::post('/charts/updatedatesting', 'Admin\ChartController@UpdateDateString')->name('admin_charts_update_date_string')->middleware('auth', 'isAdmin');

//Admin language
Route::get('/edit/{lang}/{page}', 'Admin\EditLangController@index')->middleware('auth', 'isAdmin');
Route::post('admin', 'Admin\EditLangController@saveFile')->middleware('auth', 'isAdmin');

//Admin Links
Route::get('admin/links', 'Admin\EditLinksController@index')->middleware('auth', 'isAdmin');
Route::post('admin/link', 'Admin\EditLinksController@saveLink')->middleware('auth', 'isAdmin');
Route::post('admin/email', 'Admin\EditLinksController@saveEmail')->middleware('auth', 'isAdmin');
