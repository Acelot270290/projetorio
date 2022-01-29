<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', 'LoginController@index')->name('login');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Usuários
Route::get('/usuarios', 'UserController@index')->name('usuarios');
Route::get('/usuarios/criar', 'UserController@criar')->name('criar_usuarios');
Route::post('/usuarios/adicionar', 'UserController@adicionar')->name('adicionar_usuarios');

// Acervos
//Route::get('/acervo/listar', 'AcervoController@index')->name('acervo');
Route::get('/acervo/criar', 'AcervoController@criar')->name('criar_acervo');
Route::post('/acervo/adicionar', 'AcervoController@adicionar')->name('adicionar_acervo');


// Função sair
Route::get('sair', 'TopoController@sair')->name('sair');
