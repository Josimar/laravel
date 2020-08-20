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



// Rotas de transportes
/*
Route::get('/transporte', function () {
    return \App\Transporte::all();
});
*/

Route::namespace('Api')->prefix('transportes')->group(function(){
  
    Route::get('/', 'TransporteController@index');
    Route::post('/', 'TransporteController@save');

});

