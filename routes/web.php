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
Route::get('/acervo', 'AcervoController@index')->name('acervo');
Route::get('/acervo/criar', 'AcervoController@criar')->name('criar_acervo');
Route::get('/acervo/detalhar/{id}', 'AcervoController@detalhar')->name('detalhar_acervo');
Route::get('/acervo/edita/{id}', 'AcervoController@editar')->name('editar_acervo');
//Route::get('/acervo/deletar/{id}', 'AcervoController@deletar')->name('deletar_acervo');

Route::post('/acervo/adicionar', 'AcervoController@adicionar')->name('adicionar_acervo');

// Obras
Route::get('/obra', 'ObraController@index')->name('obra');
Route::get('/obra/criar', 'ObraController@criar')->name('criar_obra');
Route::get('/obra/detalhar/{id}', 'ObraController@detalhar')->name('detalhar_obra');
Route::get('/obra/editar/{id}', 'ObraController@editar')->name('editar_obra');
Route::get('/obra/deletar/{id}', 'ObraController@deletar')->name('deletar_obra');

Route::post('/obra/adicionar', 'ObraController@adicionar')->name('adicionar_obra');

// Função sair
Route::get('sair', 'TopoController@sair')->name('sair');
