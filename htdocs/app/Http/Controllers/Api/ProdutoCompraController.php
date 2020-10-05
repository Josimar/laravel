<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProdutoRequest;
use App\Http\Resources\ProdutoCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProdutoCompraInterface;


class ProdutoCompraController extends Controller{

    private $model;

    public function __construct(ProdutoCompraInterface $model){
        $this->model = $model;
    }

    // http://localhost/laravel/api/produtos?fields=nome,quantidade&conditions=nome:LIKE:%a%
    public function index(Request $request){
        $this->model->selectCondition($request);
        $this->model->selectFilter($request);
        $produto = $this->model->getResult();

        // return response()->json($produto);
        return new ProdutoCollection($produto->paginate(10));
    }

    // http://localhost/laravel/api/produtos/paginate?page=1
    public function paginate(){
        $produto = $this->model->paginate(10);

        // return response()->json($produto);
        return new ProdutoCollection($produto);
    }

    public function show($id){
        $produto = $this->model->find($id);

        // return response()->json($produto);
        return new ProdutoCollection($produto);
    }

    // No Header precisa -> Accept => application/json
    public function save(ProdutoRequest $request){
        $data = $request->all();

        $produto = $this->model->create($data);

        return response()->json($produto);
    }

    public function update(ProdutoRequest $request){
        $data = $request->all();
        $produto = $this->model->find($data['id']);
        $produto->update($data);

        return response()->json($produto);
    }

    public function delete($id){
        $produto = $this->model->find($id);
        $produto->delete();

        return response()->json(['data'=>['msg'=>'Registry deleted']]);
    }

    public function lista(Request $request, $id){
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());
        // dd($id);

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        // usuário logado
        $usuario = auth()->user();
        // dd($usuario);

        // pego a lista atual
        $lista = $usuario->listascompra()->find($id);
        // dd($lista);

        // produtos da lista
        $produtos = $this->model->findFieldModel('listaid', '=', $lista->id);
        // dd($produtos);

        return new ProdutoCollection($produtos->paginate(10));
    }

}
