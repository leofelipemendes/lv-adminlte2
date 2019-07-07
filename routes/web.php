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
Route::get('/deptos/disable','DepartamentosController@disable')->name('depto_disable');
Route::post('/deptos/store','DepartamentosController@store')->name('depto_store');

Route::get('/home', 'HomeController@index')->name('home');
