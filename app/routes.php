<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/','LoginController@getLogin');

Route::get('login', ['uses' => 'LoginController@getLogin', 'as' => 'login']);
Route::post('login', ['before'=>'csrf','uses' => 'LoginController@postLogin']);
Route::get('logout', 'LoginController@getLogout');


Route::group(['prefix'=>'authorized','before'=>'auth'], function(){
	Route::resource('users', 'UsersController');
});

Route::group(['prefix'=>'profile','before'=>'auth'], function(){
	Route::get('/', 'ProfileController@index');
	Route::get('user', 'ProfileController@index');
	Route::get('edit', 'ProfileController@edit');
	Route::get('show', 'ProfileController@show');
	Route::patch('update', 'ProfileController@update');
	Route::get('change_password', 'ProfileController@getChange_password');
	Route::post('change_password', 'ProfileController@postChange_password');
});
