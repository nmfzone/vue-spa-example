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

Route::get('/abc/{user}/tasks', 'Api\TasksController@allByUser');

Route::post('/login', 'Auth\LoginController@login');
Route::post('/refresh-token', 'Auth\LoginController@refreshToken');
Route::post('/register', 'Auth\RegisterController@register');

Route::any('{all}', function () {
    return view('landing');
})
->where(['all' => '.*']);
