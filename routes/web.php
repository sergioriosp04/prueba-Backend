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

//rutas usuario
Route::post('/api/user/registro', 'UserController@registro');

//rutas billetera
Route::post('/api/billetera/recargar', 'billeteraController@recargar');
Route::post('/api/billetera/pagar', 'billeteraController@pagar');
Route::post('/api/billetera/confirmar', 'billeteraController@confirmar');
Route::post('/api/billetera/consultar', 'billeteraController@consultar');
