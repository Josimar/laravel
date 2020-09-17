<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Requests\ImovelRequest;
use App\Http\Resources\ImovelCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ImovelInterface;

class ImovelController extends Controller{

    private $model;

    public function __construct(ImovelInterface $model){
        $this->model = $model;
    }

    // http://localhost/laravel/api/imoveis?fields=nome,quantidade&conditions=nome:LIKE:%a%
    public function index(Request $request){
        $this->model->selectCondition($request);
        $this->model->selectFilter($request);
        $imovel = $this->model->getResult();

        // return response()->json($imovel);
        return new ImovelCollection($imovel->paginate(10));
    }

    // http://localhost/laravel/api/imoveis/paginate?page=1
    public function paginate(){
        $imovel = $this->model->paginate(10);

        // return response()->json($imovel);
        return new ImovelCollection($imovel);
    }

    public function show($id){
        try{
            $imovel = $this->model->find($id);

            return response()->json([
                'data' => $imovel
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }

        // return new ImovelCollection($imovel);
    }

    // No Header precisa -> Accept => application/json
    public function save(ImovelRequest $request){
        $data = $request->all();

        try{
            $imovel = $this->model->save($data);

            if (isset($data['categorias']) && count($data['categorias'])){
                $imovel->categorias()->sync($data['categorias']);
            }

            return response()->json([
               'data' => [
                   'msg' => 'Registry add with success'
               ]
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

    public function update($id, ImovelRequest $request){
        $data = $request->all();

        try{
            $imovel = $this->model->find($id);
            $imovel->update($data);

            if (isset($data['categorias']) && count($data['categorias'])){
                $imovel->categorias()->sync($data['categorias']);
            }

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
            $imovel = $this->model->find($id);
            $imovel->delete();

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

    public function categorias($id){
        try{
            $imovel = $this->model->find($id);

            return response()->json([
                'data' => $imovel->categorias
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

}
