<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Autenticação - Testes */
//Route::post('auth/login', 'api\\AuthController@login');
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::group(['middleware'=>['apijwt']], function(){
//    Route::get('users', 'api\\UserController@index');
//});
//Route::group(['middleware'=>['auth.basic']], function(){
//    Route::get('users', 'api\\UserController@index');
//});

// Rotas de usuários
Route::namespace('api')->prefix('v1')->group(function(){
    Route::prefix('usuarios')->group(function(){
        Route::get('/', 'UserController@index')->name('api.usuarios.index');
        Route::get('/{id}','UserController@show')->name('api.usuarios.show');
        Route::post('/', 'UserController@save')->name('api.usuarios.create');
        Route::post('/update/{id}', 'UserController@update')->name('api.usuarios.update');
        Route::post('/delete/{id}', 'UserController@delete')->name('api.usuarios.delete');
    });
});

// Rotas de categorias
Route::namespace('api')->prefix('v1')->group(function(){
    Route::prefix('categorias')->group(function(){
        Route::get('/', 'CategoriaController@index')->name('api.categorias.index');
        Route::get('/{id}','CategoriaController@show')->name('api.categorias.show');
        Route::post('/', 'CategoriaController@save')->name('api.categorias.create');
        Route::post('/update/{id}', 'CategoriaController@update')->name('api.categorias.update');
        Route::post('/delete/{id}', 'CategoriaController@delete')->name('api.categorias.delete');

        Route::get('/{id}/imoveis', 'CategoriaController@imoveis')->name('api.categorias.imoveis');
    });
});

// Rotas de listas
Route::namespace('api')->prefix('v1')->group(function(){
    Route::prefix('listas')->group(function(){
        Route::get('/', 'ListaController@index')->name('api.listas.index');
        Route::get('/{id}','ListaController@show')->name('api.listas.show');
        Route::post('/', 'ListaController@save')->name('api.listas.create');
        Route::post('/update/{id}', 'ListaController@update')->name('api.listas.update');
        Route::post('/delete/{id}', 'ListaController@delete')->name('api.listas.delete');
    });
});

// Rotas de imoveis
Route::namespace('api')->prefix('v1')->group(function(){
    Route::prefix('imoveis')->group(function(){
        Route::get('/', 'ImovelController@index')->name('api.imoveis.index');
        Route::get('/{id}','ImovelController@show')->name('api.imoveis.show');
        Route::post('/', 'ImovelController@save')->name('api.imoveis.create');
        Route::post('/update/{id}', 'ImovelController@update')->name('api.imoveis.update');
        Route::post('/delete/{id}', 'ImovelController@delete')->name('api.imoveis.delete');

        Route::get('/{id}/categorias', 'ImovelController@categorias')->name('api.imoveis.categorias');
    });
});

// Rotas de produtos
Route::namespace('api')->prefix('produtos')->group(function(){
    Route::get('/', 'ProdutoController@index');
    Route::get('/paginate', 'ProdutoController@paginate');
    Route::get('/{id}','ProdutoController@show');
    Route::post('/', 'ProdutoController@save');
    Route::put('/', 'ProdutoController@update');
    Route::patch('/', 'ProdutoController@update');
    Route::delete('/{id}', 'ProdutoController@delete');
    Route::post('/update', 'ProdutoController@update');
    Route::post('/delete/{id}', 'ProdutoController@delete');
});

// Rotas de transportes
//Route::namespace('api')->prefix('transportes')->group(function(){
//    Route::get('/', 'TransporteController@index');
//    Route::get('/paginate', 'TransporteController@paginate');
//    Route::get('/{id}','TransporteController@show');
//    Route::post('/', 'TransporteController@save')->middleware('auth.basic');
//    Route::put('/', 'TransporteController@update');
//    Route::patch('/', 'TransporteController@update');
//    Route::delete('/{id}', 'TransporteController@delete');
//    Route::post('/update', 'TransporteController@update');
//    Route::post('/delete/{id}', 'TransporteController@delete');
//});

// Rotas para Favoritos
//Route::get('/favoritos','api\FavoritoController@index');
//Route::post('/favoritos','api\FavoritoController@store');
//Route::get('/favoritos/{id}','api\FavoritoController@show');
//Route::put('/favoritos/{id}','api\FavoritoController@update');
//Route::post('/favoritos/update/{id}','api\FavoritoController@update');
//Route::delete('/favoritos/{id}','api\FavoritoController@destroy');
//Route::post('/favoritos/delete/{id}','api\FavoritoController@destroy');

Route::get('/teste', function (Request $request) {
    // Retorna uma mensagem simples
    // return ['msg', 'Teste de retorno de API'];

    // Retorna todos os requests
    // dd($request->headers->all());

    // Pega um header
    dd($request->headers->get('Authorization'));

    $response = new \Illuminate\Http\Response(json_encode(['msg', 'Teste de retorno de API']));
    $response->header('Content-Type', 'application/json');

    return $response;
});

