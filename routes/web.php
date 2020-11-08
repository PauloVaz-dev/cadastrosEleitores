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


Auth::routes();

Route::get('/', 'ClienteController@index')
    ->name('cliente.cliente.index');
/*
Route::get('/error', 'ClienteController@index')
    ->name('cliente.cliente.index');
*/

Route::group(
[
    'prefix' => 'cliente',
], function () {

    Route::get('/', 'ClienteController@index')
         ->name('cliente.cliente.index');

    Route::get('/inativos', 'ClienteController@inativos')
        ->name('cliente.inativos');

    Route::get('/inativos/grid', 'ClienteController@inativosGrid')
        ->name('cliente.inativos.grid');

    Route::get('/create','ClienteController@create')
         ->name('cliente.cliente.create');

    Route::get('/grid', 'ClienteController@grid')
         ->name('cliente.cliente.grid');

    Route::get('/grid', 'ClienteController@grid')
        ->name('cliente.cliente.grid');

    Route::get('/coordenadas','ClienteController@coordenadas')
         ->name('cliente.coordenadas')
         ->where('id', '[0-9]+');

    Route::get('/{cliente}/edit','ClienteController@edit')
         ->name('cliente.cliente.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ClienteController@store')
         ->name('cliente.cliente.store');
               
    Route::put('cliente/{cliente}', 'ClienteController@update')
         ->name('cliente.cliente.update')
         ->where('id', '[0-9]+');

    Route::post('getCliente/{cliente}', 'ClienteController@getCliente')
        ->name('cliente.getCliente.update')
        ->where('id', '[0-9]+');

    Route::delete('/{cliente}/destroy','ClienteController@destroy')
         ->name('cliente.cliente.destroy')
         ->where('id', '[0-9]+');

});





