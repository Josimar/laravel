<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return new TransporteCollection($transporte->paginate(10));
        return response()->json($transporte);
    }

    // http://localhost/laravel/api/transportes/paginate?page=2
    public function paginate(){
        $transporte = $this->transporte->paginate(10);

        // return response()->json($transporte);
        return new TransporteCollection($transporte);
    }

    public function show($id){
        $transporte = $this->transporte->find($id);

        // return response()->json($transporte);
        return new TransporteResource($transporte);
    }

    public function save(Request $request){
        $data = $request->all();

        $transporte = $this->transporte->create($data);

        return response()->json($transporte);
    }

    public function update(Request $request){
        $data = $request->all();
        $transporte = $this->transporte->find($data['id']);
        $transporte->update($data);

        return response()->json($transporte);
    }

    public function delete($id){
        $transporte = $this->transporte->find($id);
        $transporte->delete();

        return response()->json(['data'=>['msg'=>'Registry deleted']]);
    }

}
