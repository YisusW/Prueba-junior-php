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

Route::get('/', 'personController@index')->name('personas-save');

Route::post('subscrption-save' , 'personController@store');

Route::post('create-transaction', 'HomeController@confirmacion_form');

Route::get('failed' , 'HomeController@showfail' );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('verificar-transaction','TransacctionController@index');

Route::post('buscar-transaction-document' , 'TransacctionController@show' );

Route::post('buscar-transaction-id' , 'TransacctionController@showown' );

Route::get('veri-transaction' , 'TransacctionController@getStatusThis' );
	
