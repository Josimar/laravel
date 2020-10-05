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

// $response->header('Content-Type', 'application/json');

Route::namespace('api')->prefix('v1')->group(function(){
    Route::prefix('tarefas')->group(function(){
        Route::get('/', 'TarefaController@index')->name('api.tarefas.index');
    });
});

Route::namespace('api')->middleware('log.route')->prefix('v1')->group(function(){
    // Rotas de usuários
    Route::prefix('usuarios')->group(function(){
        Route::post('/login', 'LoginJwtController@login')->name('api.login');
        Route::post('/cadastro', 'LoginJwtController@cadastro')->name('api.usuarios.cadastro');

        Route::get('/', 'UserController@index')->name('api.usuarios.index');
        Route::get('/{id}','UserController@show')->name('api.usuarios.show');
        Route::post('/', 'UserController@save')->name('api.usuarios.create');
        Route::post('/update/{id}', 'UserController@update')->name('api.usuarios.update');
        Route::post('/delete/{id}', 'UserController@delete')->name('api.usuarios.delete');
    });

    // Rotas de categorias
    Route::prefix('categorias')->group(function(){
        Route::get('/', 'CategoriaController@index')->name('api.categorias.index');
        Route::get('/{id}','CategoriaController@show')->name('api.categorias.show');
        Route::post('/', 'CategoriaController@save')->name('api.categorias.create');
        Route::post('/update/{id}', 'CategoriaController@update')->name('api.categorias.update');
        Route::post('/delete/{id}', 'CategoriaController@delete')->name('api.categorias.delete');

        Route::get('/filho/{nivel}', 'CategoriaController@child')->name('api.categorias.child');

        Route::get('/{id}/imoveis', 'CategoriaController@imoveis')->name('api.categorias.imoveis');
    });

    // Rotas de listas
    Route::prefix('listas')->group(function(){
        Route::group(['middleware' => ['auth:api', 'jbs.api']], function(){
            Route::get('/', 'ListaController@index')->name('api.listas.index');
            Route::get('/{id}','ListaController@show')->name('api.listas.show');
            Route::post('/', 'ListaController@save')->name('api.listas.create');
            Route::post('/update/{id}', 'ListaController@update')->name('api.listas.update');
            Route::post('/delete/{id}', 'ListaController@delete')->name('api.listas.delete');
        });
    });

    // Rotas de lista de compras
    Route::prefix('listacompra')->group(function(){
        Route::group(['middleware' => ['auth:api', 'jbs.api']], function(){
            Route::get('/', 'ListaCompraController@index')->name('api.listacompra.index');
            Route::get('/{id}','ListaCompraController@show')->name('api.listacompra.show');
            Route::post('/', 'ListaCompraController@save')->name('api.listacompra.create');
            Route::post('/update/{id}', 'ListaCompraController@update')->name('api.listacompra.update');
            Route::post('/delete/{id}', 'ListaCompraController@delete')->name('api.listacompra.delete');
        });
    });

    // Rotas de imoveis
    Route::prefix('imoveis')->group(function(){
        Route::group(['middleware' => ['auth:api', 'jbs.api']], function(){
            Route::get('/search', 'ImovelController@search')->name('api.imoveis.search');

            Route::get('/', 'ImovelController@index')->name('api.imoveis.index');
            Route::get('/{id}','ImovelController@show')->name('api.imoveis.show');
            Route::post('/', 'ImovelController@save')->name('api.imoveis.create');
            Route::post('/update/{id}', 'ImovelController@update')->name('api.imoveis.update');
            Route::post('/delete/{id}', 'ImovelController@delete')->name('api.imoveis.delete');

            Route::get('/{id}/categorias', 'ImovelController@categorias')->name('api.imoveis.categorias');
            Route::post('/foto/delete/{id}', 'ImovelFotoController@delete')->name('api.imoveis.foto.delete');
            Route::post('/foto/setthumb/{fotoid}/{imovelid}', 'ImovelFotoController@setThumb')->name('api.imoveis.foto.setthumb');
        });
    });

    // Rotas de produtos
    Route::prefix('produtos')->group(function(){
        // Route::group(['middleware' => ['auth:api', 'jbs.api']], function(){
            Route::get('/', 'ProdutoController@index')->name('api.produtos.index');
            Route::get('/paginate', 'ProdutoController@paginate')->name('api.produtos.paginate');
            Route::get('/{id}','ProdutoController@show')->name('api.produtos.show');
            Route::post('/', 'ProdutoController@save')->name('api.produtos.save');
            Route::post('/update', 'ProdutoController@update')->name('api.produtos.update');
            Route::post('/delete/{id}', 'ProdutoController@delete')->name('api.produtos.delete');
//        });
    });

    // Rotas de transportes
    Route::prefix('transportes')->group(function(){
        Route::get('/', 'TransporteController@index')->name('api.transporte.index');
        Route::get('/paginate', 'TransporteController@paginate')->name('api.transporte.paginate');
        Route::get('/{id}','TransporteController@show')->name('api.transporte.show');
        Route::post('/', 'TransporteController@save')->name('api.transporte.create');
        Route::post('/update/{id}', 'TransporteController@update')->name('api.transporte.update');
        Route::post('/delete/{id}', 'TransporteController@delete')->name('api.transporte.delete');
    });

    // Rotas para Favoritos
    Route::prefix('favoritos')->group(function(){
        Route::get('/','FavoritoController@index');
        Route::post('/','FavoritoController@store');
        Route::get('/{id}','FavoritoController@show');
        Route::put('/{id}','FavoritoController@update');
        Route::post('/update/{id}','FavoritoController@update');
        Route::delete('/{id}','FavoritoController@destroy');
        Route::post('/delete/{id}','FavoritoController@destroy');
    });

    Route::prefix('loremipsum')->group(function(){
        route::get('/', 'UtilitariosController@loremipsum')->name('loremipsum');
    });

    Route::prefix('upload')->group(function(){
        route::post('/', 'UtilitariosController@upload')->name('upload');
    });
});



