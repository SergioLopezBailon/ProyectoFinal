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



//Admin routes
Route::get('/admin/panel','AdminController@panel')->middleware("auth","rol")->name('admin.panel');
Route::put('/admin/{user}','AdminController@update')->middleware('auth','rol')->name('admin.update');
Route::delete('/admin/{user}','AdminController@destroy')->middleware('auth','rol')->name('admin.delete');

//Juegos
Route::resource('/ruleta','RuletaController')->except('create','edit','show');
Route::post('/ruleta/nueva','RuletaController@storeRuleta')->name('ruleta.nueva');
Route::get('/ruleta/pregunta','RuletaController@preguntaStatus');
Route::put('/ruleta/jugar/{ruletum}','RuletaController@jugar')->name('ruleta.jugar');
Route::post('/ruleta/storeApuestas','RuletaController@storeApuestas');
Route::get('/ruleta/todasApuestas/{id}','RuletaController@devolverApuestas');
Route::get('/ruleta/ganador/{id}','RuletaController@ganador');
Route::get('/ruleta/balance/{id}','RuletaController@actualizarBalance');
Route::resource('/crash','CrashController');
Route::resource('/buscaminas','BuscaminasController')->except('create','edit','show')->middleware('auth');
Route::resource('/coinflip','CoinflipController')->except('create','edit','show');
Route::put('/coinflip/jugar/{coinflip}','CoinflipController@jugar')->name('coinflip.jugar')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();


Route::group([], function () {
	Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
	Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
	Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
	Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
	Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
	Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
	Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
});

Route::resource('user', 'UserController', ['except' => ['show']])->middleware('rol');
Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);


//prueba pago
Route::get('/pago/{user}',function(){
	return view('pago.pago');
})->name('pago.pago')->middleware('auth');
Route::post('/pago1/{user}','PagoController@pago')->middleware("auth")->name('pago.update');