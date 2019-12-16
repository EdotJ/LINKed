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

Route::middleware(['isBlocked', 'isDisabled'])->group(function() {
    Route::get('/material','MaterialController@index')->name('material');

    Route::get('/user/{id}/profile', 'UserController@show')->name('user.profile');
    Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::post('/user/{id}/update', 'UserController@update')->name('user.update');
    Route::get('user/settings', 'SettingsController@index')->name('settings.index');
    Route::delete('user/disable', 'SettingsController@destroy')->name('settings.disable');

    Route::middleware(['verified'])->group(function() {
        Route::resource('/posts', 'PostController');
        Route::resource('job-forms', 'JobFormController');
        Route::resource('filled-forms', 'FilledJobFormController')->except(['create']);
        Route::get('/job-forms/{job_form}/pdf', 'JobFormController@getPdf')->name('job-forms.pdf');

        Route::get('/admin/roles', 'Admin\RoleController@index')->name('roles.index');
        Route::get('/admin/roles/{user}/edit', 'Admin\RoleController@edit')->name('roles.edit');
        Route::post('/admin/roles/{user}/block', 'Admin\RoleController@disable')->name('roles.block');
        Route::post('/admin/roles/{user}/update', 'Admin\RoleController@update')->name('roles.update');

        Route::get('/admin/groups', 'Admin\GroupController@index')->name('groups.index');
        Route::get('/admin/groups/{user}/edit', 'Admin\GroupController@edit')->name('groups.edit');
        Route::post('/admin/groups/{user}/update', 'Admin\GroupController@update')->name('groups.update');
        Route::get('/admin/groups/create', 'Admin\GroupController@create')->name('groups.create');
        Route::post('/admin/groups/store', 'Admin\GroupController@store')->name('groups.store');

        Route::get('/material', 'MaterialController@getMaterials')->name('material');
        Route::get('/material/filter/', 'MaterialController@getMaterialsFilter')->name('materialfilter');
        Route::get('/material/edit/{id}', 'MaterialController@editMaterial')->name('editmaterial');
        Route::put('/material/edit/{id}', 'MaterialController@updateMaterial')->name('updatematerial');
        Route::post('/uploadmaterial', 'MaterialController@uploadMaterial')->name('uploadmaterial');
        Route::post('/downloadmaterial/{id}', 'MaterialController@downloadMaterial')->name('downloadmaterial');
        Route::post('/deletematerial/{id}', 'MaterialController@deleteMaterial')->name('deletematerial');
    });
});
