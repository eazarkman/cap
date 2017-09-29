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

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/sales', 'SalesController@index');
Route::get('/checkapp', 'SalesController@checkapp');
Route::get('/expense', 'ExpenseController@index');
Route::get('/users', 'UserController@index');
Route::get('/fetchuser', 'UserController@fetchuser');
Route::get('/destroyuser', 'UserController@deleteuser');
Route::post('/updateuser', 'UserController@updateuser');
Route::post('/user/register', 'UserController@register');