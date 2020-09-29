<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('lang/{locale?}', function($locale = 'pt_br'){
    $lang = session('lang', 'pt_br');
    session(['lang'=>$locale]);

    return back()->withInput();
})->name('lang');

Route::get('/', function(){
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function(){
  Route::post('/sign/{id}', 'HomeController@sign')->name('sign');
  Route::get('/sign/{id}', 'HomeController@signNoLogin')->name('sign');
  Route::get('/rodadas/{bolaoid}', 'HomeController@rodadas')->name('rodadas');
  Route::get('/rodadas/partidas/{rodadaid}', 'HomeController@partidas')->name('partidas');
  Route::get('/rodadas/partidas/resultado/{partidaid}', 'HomeController@resultado')->name('resultado');
  Route::put('/rodadas/partidas/resultado/{partidaid}', 'HomeController@update')->name('boloes.resultado.update');
  Route::put('/classificacao/{bolaoid}', 'HomeController@classificacao')->name('classificacao');
});

Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function(){
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/token', 'AdminController@token')->name('admin.token');

    Route::resource('usuarios', 'UsuarioController');

    Route::resource('sistemas', 'SistemaController');


    Route::resource('papeis', 'PapelController');
    Route::resource('permissoes', 'PermissaoController');

    Route::resource('boloes', 'BolaoController', ['as' => 'admin']);
    Route::resource('rodadas', 'RodadaController', ['as' => 'admin']);
    Route::resource('partidas', 'PartidaController', ['as' => 'admin']);

    Route::get('usuarios/papel/{id}', ['as'=>'usuarios.papel', 'uses'=>'UsuarioController@papel']);
    Route::post('usuarios/papel/{papel}', ['as'=>'usuarios.papel.store', 'uses'=>'UsuarioController@papelStore']);
    Route::delete('usuarios/papel/{usuario}/{papel}', ['as'=>'usuarios.papel.destroy', 'uses'=>'UsuarioController@papelDestroy']);

    Route::get('papeis/permissao/{id}', ['as'=>'papeis.permissao','uses'=>'PapelController@permissao']);
    Route::post('papeis/permissao/{permissao}', ['as'=>'papeis.permissao.store','uses'=>'PapelController@permissaoStore']);
    Route::delete('papeis/permissao/{papel}/{permissao}', ['as'=>'papeis.permissao.destroy','uses'=>'PapelController@permissaoDestroy']);
});

Route::middleware('auth')->group(function(){
    Route::resource('tarefas', 'TarefaController');

    Route::resource('listas', 'ListaController');

    Route::resource('categorias', 'CategoriaController');
    Route::get('/categorias/treeview',['as'=>'categorias.treeview', 'uses'=>'CategoriaController@treeview']);
    Route::get('/categorias/filho',['as'=>'child.categoria', 'uses'=>'CategoriaController@findchild']);
    Route::post('/categorias/atualizar/{categoriaid}',['as'=>'categorias.atualizar', 'uses'=>'CategoriaController@atualizar']);

    Route::resource('produtos', 'ProdutoController');
    Route::get('/produtos/lista/{listaid}', 'ProdutoController@lista')->name('produtos.lista');

    Route::resource('boloes', 'BolaoController');

    Route::get('/chamado', 'ChamadoController@index')->name('chamados');
    Route::get('/chamado/{id}', 'ChamadoController@detalhe');
});


