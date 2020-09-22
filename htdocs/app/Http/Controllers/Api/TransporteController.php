<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransporteRequest;
use App\Http\Resources\TransporteResource;
use App\Http\Resources\TransporteCollection;
use App\Repositories\Contracts\TransporteInterface;


class TransporteController extends Controller{

    private $transporte;
    private $model;

    public function __construct(TransporteInterface $model){
        $this->transporte = $model;
        $this->model = $model;
    }

    public function index(Request $request){
        $this->model->selectCondition($request);
        $this->model->selectFilter($request);
        $transporte = $this->model->getResult();

        // return $transporte->all();
        return new TransporteCollection($transporte->paginate(2));
        // return response()->json($transporte);
    }

    // http://localhost/laravel/api/transportes/paginate?page=2
    public function paginate(){
        $transporte = $this->transporte->paginate(10);

        // return response()->json($transporte);
        return new TransporteCollection($transporte);
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
    }

    public function save(TransporteRequest $request){
        $data = $request->all();

        $images = $request->file['images'];

        try{
            $transporte = $this->transporte->save($data);

            if ($images){
                $imageUpload = [];
                foreach ($images as $image){
                    $path = $image->store('upload', 'public');
                    $imageUpload[] = ['foto' => $path, 'thumb' => false];
                }

                $transporte->fotos()->createmany($imageUpload);
            }

            return response()->json(
                $transporte
                /*[
                'data' => [
                    'msg' => 'Registry add with success'
                ]
            ]*/, 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

    public function update($id, TransporteRequest $request){
        $data = $request->all();

        $images = $request->file['images'];

        try{
            $transporte = $this->model->find($id);
            $transporte->update($data);

            if ($images){
                $imageUpload = [];
                foreach ($images as $image){
                    $path = $image->store('upload', 'public');
                    $imageUpload[] = ['foto' => $path, 'thumb' => false];
                }

                $transporte->fotos()->createmany($imageUpload);
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
            $transporte = $this->transporte->find($id);
            $transporte->delete();

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
