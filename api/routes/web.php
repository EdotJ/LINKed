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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/posts', 'PostController');

Route::get('/material','MaterialController@index')->name('material');

Route::resource('job-forms', 'JobFormController');
Route::resource('filled-forms', 'FilledJobFormController')->except(['create']);

Route::get('/user/{id}/profile', 'UserController@show')->name('user.profile');
Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
Route::get('/user/{id}/update', 'UserController@update')->name('user.update');

Route::get('/admin/roles', 'Admin\RoleController@index')->name('roles.index');
Route::get('/admin/roles/{id}/edit', 'Admin\RoleController@edit')->name('roles.edit');
Route::post('/admin/roles/{id}/block', 'Admin\RoleController@disable')->name('roles.block');

Route::get('/admin/groups', 'Admin\GroupController@index')->name('groups.index');
Route::get('/admin/groups/{id}/edit', 'Admin\GroupController@edit')->name('groups.edit');
Route::get('/admin/groups/create', 'Admin\GroupController@create')->name('groups.create');
