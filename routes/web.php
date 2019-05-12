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
Route::get('/', 'FacturaController@index');
Route::get('/factura/list', 'FacturaController@list');
Route::get('/factura/detalle/{id?}', 'FacturaController@detalle');


Route::get('/clientes/list', 'ClienteController@list');

Route::get('/productos/list', 'ProductoController@list');

Route::post('/factura/guardar','FacturaController@store');

Route::get('/factura/ver/{id}', 'FacturaController@getDataFactura');

Route::get('/factura/eliminar/{id}', 'FacturaController@destroy');
