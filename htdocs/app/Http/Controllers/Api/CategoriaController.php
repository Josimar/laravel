<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Requests\CategoriaRequest;
use App\Http\Resources\CategoriaCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoriaInterface;

class CategoriaController extends Controller{

    private $model;

    public function __construct(CategoriaInterface $model){
        $this->model = $model;
    }

    // http://localhost/laravel/api/categorias?fields=nome,quantidade&conditions=nome:LIKE:%a%
    public function index(Request $request){
        $this->model->selectCondition($request);
        $this->model->selectFilter($request);
        $categoria = $this->model->getResult();

        // return response()->json($lista);
        return new CategoriaCollection($categoria->paginate(10));
    }

    public function child($nivel, Request $request){
        $this->model->selectCondition($request);
        $this->model->selectFilter($request);
        $categoria = $this->model->getResult();

        // return response()->json($lista);
        return new CategoriaCollection($categoria->paginate(100));
    }

    // http://localhost/laravel/api/categorias/paginate?page=1
    public function paginate(){
        $categoria = $this->model->paginate(10);

        // return response()->json($categoria);
        return new CategoriaCollection($categoria);
    }

    public function show($id, Request $request){
        try{
            $categoria = $this->model->find($id);

            return response()->json([
                'data' => $categoria
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }

        // return new CategoriaCollection($categoria);
    }

    // No Header precisa -> Accept => application/json
    public function save(CategoriaRequest $request){
        $data = $request->all();

        try{
            $categoria = $this->model->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'Registry add with success',
                    'data' => $categoria
                ]
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

    public function update($id, CategoriaRequest $request){
        $data = $request->all();

        try{
            $categoria = $this->model->find($id);
            $categoria->update($data);

            // return response()->json($imovel);
            return response()->json([
                'data' => [
                    'msg' => 'Registry updated with success'
                ]
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

    public function delete($id){
        try{
            $categoria = $this->model->find($id);
            $categoria->delete();

            // return response()->json($imovel);
            return response()->json([
                'data' => [
                    'msg' => 'Registry deleted with success'
                ]
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

    public function imoveis($id){
        try{
            $categoria = $this->model->find($id);

            return response()->json([
                'data' => $categoria->imoveis
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

}
