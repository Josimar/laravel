<?php
namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListaCompraRequest;
use App\Http\Resources\ListaCompraCollection;
use App\Repositories\Contracts\ListaCompraInterface;

class ListaCompraController extends Controller{
    private $model;

    public function __construct(ListaCompraInterface $model){
        $this->model = $model;
    }

    public function index(Request $request){
        $this->model->selectCondition($request);
        $this->model->selectFilter($request);
        $lista = $this->model->getResult();

        $usuario = auth()->user();

        // return response()->json($usuario->listas($request));
        return new ListaCompraCollection($usuario->listacompra()->paginate(100));
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
    public function save(ListaCompraRequest $request){
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

    public function update($id, ListaCompraRequest $request){
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

