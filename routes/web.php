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

Route::get('/admin', 'AdminController@index');
Route::get('/admin/user', 'AdminController@user');
Route::get('/admin/product', 'AdminController@product');
Route::get('/admin/category', 'AdminController@category');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/logout', 'Auth\LoginController@logout');
