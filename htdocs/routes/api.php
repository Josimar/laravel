<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/login', 'api\\AuthController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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

/*
Route::group(['middleware'=>['apijwt']], function(){
    Route::get('users', 'api\\UserController@index');
});
*/
Route::group(['middleware'=>['auth.basic']], function(){
    Route::get('users', 'api\\UserController@index');
});


// Rotas de transportes
Route::namespace('api')->group(function(){

    Route::prefix('transportes')->group(function(){

        Route::get('/', 'TransporteController@index');
        Route::get('/paginate', 'TransporteController@paginate');
        Route::get('/{id}','TransporteController@show');
        Route::post('/', 'TransporteController@save')->middleware('auth.basic');
        // Route::post('/', 'TransporteController@save')->middleware('auth.basic');
        Route::put('/', 'TransporteController@update');
        Route::patch('/', 'TransporteController@update');
        Route::delete('/{id}', 'TransporteController@delete');
        Route::post('/update', 'TransporteController@update');
        Route::post('/delete/{id}', 'TransporteController@delete');

    });

    // Route::resource('/users', 'UserController');

});



// Rotas para Favoritos
Route::get('/favoritos','api\FavoritoController@index');
Route::post('/favoritos','api\FavoritoController@store');
Route::get('/favoritos/{id}','api\FavoritoController@show');
Route::put('/favoritos/{id}','api\FavoritoController@update');
Route::post('/favoritos/update/{id}','api\FavoritoController@update');
Route::delete('/favoritos/{id}','api\FavoritoController@destroy');
Route::post('/favoritos/delete/{id}','api\FavoritoController@destroy');
