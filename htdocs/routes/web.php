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
Auth::routes();

Route::get('/', ['uses'=>'Controller@homepage']);

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::group(['middleware'=>'auth', 'prefix'=>'admin'], function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin');

    Route::resource('usuarios', 'Admin\UsuarioController');
    Route::resource('papeis', 'Admin\PapelController');

    Route::get('usuarios/papel/{id}', ['as'=>'usuarios.papel', 'uses'=>'Admin\UsuarioController@papel']);
    Route::post('usuarios/papel/{papel}', ['as'=>'usuarios.papel.store', 'uses'=>'Admin\UsuarioController@papelStore']);
    Route::delete('usuarios/papel/{usuario}/{papel}', ['as'=>'usuarios.papel.destroy', 'uses'=>'Admin\UsuarioController@papelDestroy']);

    Route::get('papeis/permissao/{id}', ['as'=>'papeis.permissao','uses'=>'Admin\PapelController@permissao']);
    Route::post('papeis/permissao/{permissao}', ['as'=>'papeis.permissao.store','uses'=>'Admin\PapelController@permissaoStore']);
    Route::delete('papeis/permissao/{papel}/{permissao}', ['as'=>'papeis.permissao.destroy','uses'=>'Admin\PapelController@permissaoDestroy']);
});

Route::get('/chamado', 'ChamadoController@index')->name('chamados');
Route::get('/chamado/{id}', 'ChamadoController@detalhe');

