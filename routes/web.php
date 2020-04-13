<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//User routes
Route::get('/user/perfil','UserController@perfil')->middleware('auth')->name('user.perfil');
Route::get('/user/{user}/edit','UserController@edit')->middleware('auth')->name('user.edit');
Route::delete('/user/{user}','UserController@destroy')->middleware('auth')->name('user.delete');
Route::put('/user/{user}','UserController@update')->middleware('auth')->name('user.update');
//Admin routes
Route::get('/admin/panel','AdminController@panel')->middleware("auth","rol")->name('admin.panel');
Route::put('/admin/{user}','AdminController@update')->middleware('auth','rol')->name('admin.update');
Route::delete('/admin/{user}','AdminController@delete')->middleware('auth','rol')->name('admin.delete');