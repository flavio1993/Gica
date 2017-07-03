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
    return view('auth.login');
});

Auth::routes();



Route::resource('datos', 'MachineController');
Route::resource('datos_api', 'MachineController@listar');
Route::resource('mercado', 'MercadoController');
Route::resource('listar_precios', 'MercadoController@listarPrecios');
Route::resource('listar_caracteristicas', 'MercadoController@listarCaracteristicas');
Route::resource('listar_operador', 'MercadoController@listarOperador');


Route::resource('maquinaria', 'CostController');

Route::resource('calculo', 'CalculoController');

Route::resource('productividad', 'ProductividadController');
Route::get('parametros/{value}', 'ProductividadController@listra_parametros');

Route::get('/prueba', 'PruebaController@index');

Route::resource('price', 'PriceController');
Route::resource('characteristic', 'CharacteristicController');
Route::resource('operator', 'OperatorController');