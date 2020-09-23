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

Route::get('/','IndexController@index')->name('index');
Route::get('/help','IndexController@help')->name('help');

Route::get('signup', 'UsersController@create')->name('signup');

Route::resource('users', 'UsersController');
// Route::get('/users/{user}', 'UsersController@show')->name('users.show');     显示用户个人信息
// Route::get('/users', 'UsersController@index')->name('users.index');          显示用户列表
// Route::get('/users/create', 'UsersController@create')->name('users.create'); 创建用户的页面
// Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');编辑用户的页面
// Route::post('/users', 'UsersController@store')->name('users.store');         创建用户
// Route::patch('/users/{user}', 'UsersController@update')->name('users.update');更新用户
// Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');删除用户