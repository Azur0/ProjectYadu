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

Route::get('/edit/{lang}/{page}', 'EditLangController@index');
Route::post('admin', 'EditLangController@saveFile');

Route::get('/account/myevents', 'HomeController@myEvents');
Route::get('/account/participating', 'HomeController@participating');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::get('/location','API\LocationController@isWithinReach');
Route::get('events/{id}/join', 'EventsController@join');
Route::get('events/{id}/leave', 'EventsController@leave');

Route::post('/events/action', 'EventsController@action')->name('events_controller.action');
Route::post('/events/actionDistanceFilter', 'EventsController@actionDistanceFilter')->name('events_controller.actionDistanceFilter');

Auth::routes(['verify' => true]);

//Profile
Route::get('profile/edit', 'ProfileController@edit')->middleware('auth');
Route::post('/profile/updateProfile', 'AccountController@updateProfile')->middleware('auth');
Route::post('/profile/changePassword', 'AccountController@changePassword')->middleware('auth');
Route::post('/profile/deleteAccount', 'AccountController@deleteAccount')->middleware('auth');

Auth::routes();

Route::resource('events', 'EventsController');

Route::get('admin', function () { return view('admin.index');})->middleware('auth', 'isAdmin');

Route::post('/language', 'LanguageController@setLanguage');

Route::get('admin/accounts', 'Management\AccountsController@index')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}', 'Management\AccountsController@show')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}/activate', 'Management\AccountsController@activate')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}/delete', 'Management\AccountsController@destroy')->middleware('auth', 'isAdmin');
Route::post('admin/accounts/{id}/update', 'Management\AccountsController@update')->middleware('auth', 'isAdmin');
Route::get('admin/accounts/{id}/avatarreset', 'Management\AccountsController@resetavatar')->middleware('auth', 'isAdmin');

Route::post('admin/accounts/action', 'Management\AccountsController@action')->name('admin_accounts_controller.action');

Route::resource('admin/events','Management\EventsController');
Route::post('/admin/events/actionDistanceFilter', 'Management\EventsController@actionDistanceFilter')->name('admin_events_controller.actionDistanceFilter');

// admin/images
Route::get('admin/images/category', 'Management\ImagesController@showtype')->name('imagescontroller.index')->middleware('auth', 'isAdmin');
Route::post('admin/images/category', 'Management\ImagesController@passthrough')->middleware('auth', 'isAdmin');
Route::get('admin/images/category/check', 'Management\ImagesController@checkforevent')->name('imagescontroller.checkforevent')->middleware('auth','isAdmin'); 
Route::post('admin/images/category/remove', 'Management\ImagesController@removetype')->name('imagescontroller.removetype')->middleware('auth', 'isAdmin');
Route::post('admin/images/category/removeTypeOff', 'Management\ImagesController@deleteCategoryPicture')->name('events_controller.deleteCategoryPicture')->middleware('auth', 'isAdmin');;
Route::post('admin/images/category/overrideremove', 'Management\ImagesController@overrideremove')->name('imagescontroller.overrideremove')->middleware('auth', 'isAdmin');
Route::post('admin/images/category/addtype', 'Management\ImagesController@addtype')->name('imagescontroller.addtype')->middleware('auth', 'isAdmin');
Route::get('admin/images/extra', 'Management\ImagesController@showextra')->middleware('auth', 'isAdmin');
Route::post('admin/images/extra', 'Management\ImagesController@check')->middleware('auth', 'isAdmin');