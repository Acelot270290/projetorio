<?php

use App\Mail\MensagemMail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
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
Route::get('/unauthorized', 'HomeController@unauthorized')->name('unauthorized');

// Usuários
Route::get('/usuarios', 'UserController@index')->name('usuarios');
Route::get('/usuarios/criar', 'UserController@criar')->name('criar_usuario');

Route::post('/usuarios/adicionar', 'UserController@adicionar')->name('adicionar_usuario');

// Acervos
Route::get('/acervo', 'AcervoController@index')->name('acervo');
Route::get('/acervo/criar', 'AcervoController@criar')->name('criar_acervo');
Route::get('/acervo/detalhar/{id}', 'AcervoController@detalhar')->name('detalhar_acervo');
Route::get('/acervo/editar/{id}', 'AcervoController@editar')->name('editar_acervo');

Route::post('/acervo/adicionar', 'AcervoController@adicionar')->name('adicionar_acervo');
Route::post('/acervo/atualizar/{id}', 'AcervoController@atualizar')->name('atualizar_acervo');
Route::post('/acervo/deletar/{id}', 'AcervoController@deletar')->name('deletar_acervo');

Route::get('/acervo/{id}/obras', 'AcervoController@getObrasAcervo')->name('acervo_obras');

// Obras
Route::get('/obra', 'ObraController@index')->name('obra');
Route::get('/obra/criar', 'ObraController@criar')->name('criar_obra');
Route::get('/obra/detalhar/{id}', 'ObraController@detalhar')->name('detalhar_obra');
Route::get('/obra/editar/{id}', 'ObraController@editar')->name('editar_obra');

Route::post('/obra/adicionar', 'ObraController@adicionar')->name('adicionar_obra');
Route::post('/obra/atualizar/{id}', 'ObraController@atualizar')->name('atualizar_obra');
Route::post('/obra/deletar/{id}', 'ObraController@deletar')->name('deletar_obra');

//Busca Obras
Route::get('/busca-obras', 'BuscaObrasController@index')->name('busca_obras');

//Redefinição de senha
Mail::to('reset@alandiniz.com.br')->send(new MensagemMail());

//notificação de cadastro
Mail::send(new MensagemMail());


//Cadastro Localização Obas
Route::post('/localicao-obras/adicionar', 'LocalizacoesObrasController@adicionar')->name('adicionar_localicacao');

//Cadastro Tesauro Obas
Route::post('/tesauro/adicionar', 'TesauroObrasController@adicionar')->name('adicionar_tesauro');

//Cadastro Material
Route::post('/material/adicionar', 'MaterrialObrasController@adicionar')->name('adicionar_material');

//Cadastro Material
Route::post('/tecnica/adicionar', 'TecnicaslObrasController@adicionar')->name('adicionar_tecnica');

//Cadastro Especificação de Obras
Route::post('/especificacao-obras/adicionar', 'EspecificacaoObrasController@adicionar')->name('adicionar_especificacao_obras');

//Cadastro Especificação de  Segurança Obras
Route::post('/especificacao-seguranca-obras/adicionar', 'EspecificacaoSegurancaObrasController@adicionar')->name('adicionar_especificacao_seg_obras');

//Cadastro Especificação de  Acervo
Route::post('/especificacao-acervos/adicionar', 'EspecificacaoAcervosController@adicionar')->name('adicionar_especificacao_acervos');

//Lipando o cache do site
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// Função sair
Route::get('sair', 'TopoController@sair')->name('sair');
