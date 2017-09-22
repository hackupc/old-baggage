<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
  return redirect('list');
});
Route::get('list', 'HomeController@index');
Route::get('create', 'HomeController@create');
Route::get('create/{position}', 'HomeController@createSpecific');
Route::get('create/more/{id}/{name}/{surname}', 'HomeController@createMore');
Route::post('create/{id}/{name}/{surname}/{desc}/{spe}', 'HomeController@registerSpecific');
Route::post('create/{id}/{name}/{surname}/{desc}/{row}/{col}', 'HomeController@registerSpecificPosition');
Route::get('history', 'HomeController@history');
Route::get('search', 'HomeController@search');
Route::get('user/{id}', 'HomeController@userSpecific');
Route::post('user/{id}', 'HomeController@userSpecific');
Route::get('remove/{id}', 'HomeController@deleteSpecific');
Route::get('baggage/{created}/{position}', 'HomeController@indexSpecific');
Route::get('baggage/new/{created}/{position}', 'HomeController@indexSpecificNew');
Route::get('print/{row}/{col}/{id}/{name}/{surname}/{created}/{removed}/{reprint}', 'HomeController@print');

Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

//Route::auth();
