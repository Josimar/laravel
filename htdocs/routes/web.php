<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('lang/{locale?}', function($locale = 'pt_br'){
    $lang = session('lang', 'pt_br');
    session(['lang'=>$locale]);
    
    return back()->withInput();
})->name('lang');

Route::get('/', function(){
    return view('home');
});

Route::get('/welcome/{locale?}', function ($locale = 'pt_br') {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->namespace('Admin')->group(function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin');

    Route::resource('usuarios', 'UsuarioController');
    Route::resource('papeis', 'PapelController');

    Route::get('usuarios/papel/{id}', ['as'=>'usuarios.papel', 'uses'=>'UsuarioController@papel']);
    Route::post('usuarios/papel/{papel}', ['as'=>'usuarios.papel.store', 'uses'=>'UsuarioController@papelStore']);
    Route::delete('usuarios/papel/{usuario}/{papel}', ['as'=>'usuarios.papel.destroy', 'uses'=>'UsuarioController@papelDestroy']);

    Route::get('papeis/permissao/{id}', ['as'=>'papeis.permissao','uses'=>'PapelController@permissao']);
    Route::post('papeis/permissao/{permissao}', ['as'=>'papeis.permissao.store','uses'=>'PapelController@permissaoStore']);
    Route::delete('papeis/permissao/{papel}/{permissao}', ['as'=>'papeis.permissao.destroy','uses'=>'PapelController@permissaoDestroy']);
});

Route::get('/chamado', 'ChamadoController@index')->name('chamados');
Route::get('/chamado/{id}', 'ChamadoController@detalhe');
