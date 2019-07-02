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

Route::get('/deptos','DepartamentosController@index')->name('depto');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
