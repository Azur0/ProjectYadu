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

Route::get('/edit/{lang}/{page}', 'EditLangController@index')->middleware('auth', 'isAdmin');
Route::post('admin', 'EditLangController@saveFile')->middleware('auth', 'isAdmin');

Route::get('admin/links', 'EditLinksController@index')->middleware('auth', 'isAdmin');
Route::post('admin/link', 'EditLinksController@saveLink')->middleware('auth', 'isAdmin');
Route::post('admin/email', 'EditLinksController@saveEmail')->middleware('auth', 'isAdmin');

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
Route::get('/profile/edit', 'AccountController@edit')->middleware('auth');
Route::get('/profile/{id}/follow', 'AccountController@follow')->middleware('auth');
Route::get('/profile/{id}/accept', 'AccountController@accept')->middleware('auth');
Route::get('/profile/{id}/decline', 'AccountController@decline')->middleware('auth');
Route::get('/profile/{id}/unfollow', 'AccountController@unfollow')->middleware('auth');
Route::post('/profile/updateProfile', 'AccountController@updateProfile')->middleware('auth');
Route::post('/profile/changePassword', 'AccountController@changePassword')->middleware('auth');
Route::post('/profile/deleteAccount', 'AccountController@deleteAccount')->middleware('auth');
Route::patch('/profile/updateAccountSettings/{id}', 'AccountController@updateSettings')->middleware('auth');
Route::post('/profile/blockUser', 'AccountController@blockAccount')->middleware('auth');
Route::post('/profile/unblockUser/', 'AccountController@unblockAccount')->middleware('auth');

Auth::routes();

Route::resource('events', 'EventsController');

Route::get('admin', function () { return view('admin.index');})->middleware('auth', 'isAdmin');

Route::post('/language', 'LanguageController@setLanguage');

// Why did you not use resource for index/show/delete/update?
Route::get('admin/accounts', 'Management\AccountsController@index')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}', 'Management\AccountsController@show')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}/activate', 'Management\AccountsController@activate')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}/delete', 'Management\AccountsController@destroy')->middleware('auth', 'isAdmin');
Route::post('admin/accounts/{id}/update', 'Management\AccountsController@update')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}/avatarreset', 'Management\AccountsController@resetavatar')->middleware('auth', 'isAdmin');

Route::post('admin/accounts/action', 'Management\AccountsController@action')->name('admin_accounts_controller.action');

Route::resource('admin/events','Management\EventsController');
Route::post('/admin/events/actionDistanceFilter', 'Management\EventsController@actionDistanceFilter')->name('admin_events_controller.actionDistanceFilter');

// admin/images/category
Route::get('admin/images/category', 'Management\ImagesController@showtype')->name('imagescontroller.index')->middleware('auth', 'isAdmin');
Route::post('admin/images/category/addtype', 'Management\ImagesController@addtype')->name('imagescontroller.addtype')->middleware('auth', 'isAdmin');
Route::post('admin/images/category/removetype', 'Management\ImagesController@removetype')->name('imagescontroller.removetype')->middleware('auth', 'isAdmin');
Route::post('admin/images/category/checktiedpictures', 'Management\ImagesController@checktiedpictures')->name('imagescontroller.checktiedpictures')->middleware('auth', 'isAdmin');
Route::post('admin/images/category/deleteeventpicture', 'Management\ImagesController@deleteeventpicture')->name('events_controller.deleteeventpicture')->middleware('auth', 'isAdmin');
Route::post('admin/images/category/trueremove', 'Management\ImagesController@trueremove')->name('imagescontroller.trueremove')->middleware('auth', 'isAdmin');
Route::post('admin/images/category/addeventpicture/{id}', 'Management\ImagesController@addeventpicture')->name('imagescontroller.addeventpicture')->middleware('auth', 'isAdmin');
Route::get('admin/images/category/edittagpicture/{id}', 'Management\ImagesController@edittagpicture')->name('imagescontroller.edittagpicture')->middleware('auth', 'isAdmin');

// admin/images/extra
Route::get('admin/images/extra', 'Management\ImagesController@showextra')->middleware('auth', 'isAdmin');
Route::post('admin/images/extra', 'Management\ImagesController@update')->name('imagescontroller.update')->middleware('auth', 'isAdmin');
Route::resource('admin/swearWords','Management\ProhibitedWordsController');
Route::get('admin/prohibitedWords', 'Management\ProhibitedWordsController@index')->middleware('auth', 'isAdmin');
Route::post('admin/prohibitedWords/delete', 'Management\ProhibitedWordsController@destroy')->middleware('auth', 'isAdmin');
Route::post('admin/prohibitedWords/update', 'Management\ProhibitedWordsController@update')->middleware('auth', 'isAdmin');
Route::post('admin/prohibitedWords/create', 'Management\ProhibitedWordsController@create')->middleware('auth', 'isAdmin');

Route::post('/logger/eventshared', 'LogController@LogEventShared')->name('LogEventShared');

Route::post('/charts/totaleventscreated', 'ChartController@GetTotalEventsCreated')->name('admin_charts_events')->middleware('auth', 'isAdmin');
Route::post('/charts/shares', 'ChartController@GetShares')->name('admin_charts_shares')->middleware('auth', 'isAdmin');
Route::post('/charts/activeeventlocations', 'ChartController@GetActiveEventLocations')->name('admin_charts_locations')->middleware('auth', 'isAdmin');
Route::post('/charts/categories', 'ChartController@GetCategories')->name('admin_charts_categories')->middleware('auth', 'isAdmin');
Route::post('/charts/chatmessages', 'ChartController@GetChatmessages')->name('admin_charts_chatmessages')->middleware('auth', 'isAdmin');
Route::post('/charts/accountscreated', 'ChartController@GetAccountsCreated')->name('admin_charts_accounts_created')->middleware('auth', 'isAdmin');
Route::post('/charts/updatedatesting', 'ChartController@UpdateDateString')->name('admin_charts_update_date_string')->middleware('auth', 'isAdmin');
