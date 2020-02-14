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
Route::post('/api/user/register', 'UserController@registro');

//rutas billetera
Route::post('/api/billetera/recargar', 'UserController@registro');
Route::post('/api/billetera/pagar', 'UserController@registro');
Route::post('/api/billetera/confirmar', 'UserController@registro');
Route::get('/api/billetera/consultar', 'UserController@registro');
