<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/auth'], function(){
	Route::get('/login', 'AuthController@loginForm');
	Route::post('/login', 'AuthController@login')->name('login');
	Route::get('/register', 'AuthController@registerForm');
	Route::post('/register', 'AuthController@register')->name('register');
	Route::get('/logout', 'AuthController@logout')->name('logout');
});

// Route::group(['prefix' => '/profile'], function(){
// 	Route::get('/statistics', 'Profile@show')->name('statistics');
// });
// 
Route::resource('profile', 'ProfileController')->only(['show', 'edit', 'update']);
Route::get('/calcuator', 'CalculatorController@index');
