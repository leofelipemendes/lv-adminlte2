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
    return view('auth/login');
});
//Route::get('/deptos',function(){
//    return view('departamentos.deptos'); 
//})->name('depto');

Auth::routes();
Route::get('/deptos','DepartamentosController@index')->name('depto_index');
Route::get('/deptos/create','DepartamentosController@create')->name('depto_create');
Route::get('/deptos/edit/{id}','DepartamentosController@edit')->name('depto_edit');
Route::put('/deptos/update/{id}','DepartamentosController@update')->name('depto_update');
Route::get('/deptos/disable/{id}','DepartamentosController@disable')->name('depto_disable');
Route::post('/deptos/store','DepartamentosController@store')->name('depto_store');

Route::get('/cbanc','ContasBancariasController@index')->name('cbanc_index');
Route::get('/cbanc/create','ContasBancariasController@create')->name('cbanc_create');
Route::get('/cbanc/edit/{id}','ContasBancariasController@edit')->name('cbanc_edit');
Route::put('/cbanc/update/{id}','ContasBancariasController@update')->name('cbanc_update');
Route::get('/cbanc/disable/{id}','ContasBancariasController@disable')->name('cbanc_disable');
Route::post('/cbanc/store','ContasBancariasController@store')->name('depto_store');

Route::get('/categoria','CategoriasController@index')->name('categ_index');
Route::get('/categoria/create','CategoriasController@create')->name('categ_create');
Route::get('/categoria/edit/{id}','CategoriasController@edit')->name('categ_edit');
Route::put('/categoria/update/{id}','CategoriasController@update')->name('categ_update');
Route::get('/categoria/disable/{id}','CategoriasController@disable')->name('categ_disable');
Route::post('/categoria/store','CategoriasController@store')->name('categ_store');

Route::get('/bancos','BancosController@index')->name('bancos_index');
Route::get('/bancos/create','BancosController@create')->name('bancos_create');
Route::get('/bancos/edit/{id}','BancosController@edit')->name('bancos_edit');
Route::put('/bancos/update/{id}','BancosController@update')->name('bancos_update');
Route::get('/bancos/disable/{id}','BancosController@disable')->name('bancos_disable');
Route::post('/bancos/store','BancosController@store')->name('bancos_store');

Route::get('/cliente','ClientesController@index')->name('cliente_index');
Route::get('/cliente/create','ClientesController@create')->name('cliente_create');
Route::get('/cliente/edit/{id}','ClientesController@edit')->name('cliente_edit');
Route::put('/cliente/update/{id}','ClientesController@update')->name('cliente_update');
Route::get('/cliente/disable/{id}','ClientesController@disable')->name('cliente_disable');
Route::post('/cliente/store','ClientesController@store')->name('cliente_store');

Route::get('/fornecedor','FornecedoresController@index')->name('fornecedor_index');
Route::get('/fornecedor/create','FornecedoresController@create')->name('fornecedor_create');
Route::get('/fornecedor/edit/{id}','FornecedoresController@edit')->name('fornecedor_edit');
Route::put('/fornecedor/update/{id}','FornecedoresController@update')->name('fornecedor_update');
Route::get('/fornecedor/disable/{id}','FornecedoresController@disable')->name('fornecedor_disable');
Route::post('/fornecedor/store','FornecedoresController@store')->name('fornecedor_store');
Route::get('/municipios/{id}','MunicipiosController@show')->name('municipios');

Route::get('/home', 'HomeController@index')->name('home');
