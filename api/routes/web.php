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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/{id}/profile', 'UserController@show')->name('user.profile');
Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
Route::get('/user/{id}/update', 'UserController@update')->name('user.update');
