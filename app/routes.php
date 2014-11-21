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


Route::resource('login', 'SecurityController');
Route::resource('users', 'UsersController');

Route::group(array('before' => ['acl']), function() {
	Route::get('/', function() {
		return View::make('pages.home');
	});
	Route::get('about', function() {
		return View::make('pages.about');
	});
	Route::get('projects', function() {
		return View::make('pages.projects');
	});
	Route::get('contact', function() {
		return View::make('pages.contact');
	});
});