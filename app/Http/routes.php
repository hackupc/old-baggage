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
Route::get('list/{position}', 'HomeController@indexSpecific');
Route::get('create', 'HomeController@create');
Route::get('create/{position}', 'HomeController@createSpecific');
Route::get('history', 'HomeController@history');
Route::get('search', 'HomeController@search');

Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

//Route::auth();
