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


Route::get('users', 'UserController@users');
Route::post('users', 'UserController@filterUser');

//Detail
Route::get('user/{id}', 'UserController@getDetail')->name('user-detail');

Route::post('user', 'UserController@postUser')->name('post-user');

Route::get('user-table', 'UserController@userTable');

Route::get('new-user', 'UserController@newUser');


Route::post('delete-user', 'UserController@deleteUser');