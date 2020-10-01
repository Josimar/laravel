<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Requests\ListaRequest;
use App\Http\Resources\ListaCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ListaInterface;

class ListaController extends Controller{

    private $model;

    public function __construct(ListaInterface $model){
        $this->model = $model;
    }

    // http://localhost/laravel/api/listas?fields=nome,quantidade&conditions=nome:LIKE:%a%
    public function index(Request $request){
        $this->model->selectCondition($request);
        $this->model->selectFilter($request);
        $lista = $this->model->getResult();

        $usuario = auth()->user();

        // return response()->json($usuario->listas($request));
        return new ListaCollection($usuario->listas);
    }

    // http://localhost/laravel/api/listas/paginate?page=1
    public function paginate(){
        $lista = $this->model->paginate(10);

        // return response()->json($lista);
        return new ListaCollection($lista);
    }

    public function show($id){
        try{
            $lista = $this->model->find($id);

            return response()->json([
                'data' => $lista
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }

        // return new ListaCollection($lista);
    }

    // No Header precisa -> Accept => application/json
    public function save(ListaRequest $request){
        $data = $request->all();
        $usuario = auth()->user();
        $idUser = $usuario->id;
        $data['usuarioid'] = $idUser;

        try{
            $lista = $this->model->save($data);

            $lista->usuarios()->attach($usuario);

            return response()->json([
                'data' => [
                    'msg' => 'Registry add with success',
                    'data' => $lista
                ]
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

    public function update($id, ListaRequest $request){
        $data = $request->all();

        try{
            $lista = $this->model->find($id);
            $lista->update($data);

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
            $lista = $this->model->find($id);
            $lista->delete();

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

}
