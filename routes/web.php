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
    return redirect(route('login'));
});

Route::group(['prefix' => '/auth'], function(){
	Route::get('/login', 'AuthController@loginForm');
	Route::post('/login', 'AuthController@login')->name('login');
	Route::get('/register', 'AuthController@registerForm');
	Route::post('/register', 'AuthController@register')->name('register');
	Route::get('/logout', 'AuthController@logout')->name('logout');

	Route::get('/forgot-password', 'AuthController@passwordForm')->name('password');
	Route::post('/password/mail', 'AuthController@passwordResetMail');
	Route::get('/forgot-password/{token}', 'AuthController@resetForm');
	Route::post('/password/reset', 'AuthController@passwordReset');

	Route::get('/verify/{token}', 'AuthController@verifyEmail');
});


Route::resource('profile', 'ProfileController')->only(['show', 'edit', 'update']);

Route::group(['prefix' => '/calculator'], function(){
	Route::post('/add', 'CalculatorController@add');
	Route::get('/{date?}', 'CalculatorController@index')->name('calculator');
	Route::delete('/{id}', 'CalculatorController@delete');
});

Route::get('/statistics/{startDate?}/{endDate?}', 'CalculatorController@statistics')->name('statistics');
Route::post('/statistics', 'CalculatorController@filter')->name('statistics-filter');
