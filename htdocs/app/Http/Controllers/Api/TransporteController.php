<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transporte;
use App\Http\Resources\TransporteResource;
use App\Http\Resources\TransporteCollection;


class TransporteController extends Controller
{
    
    private $transporte;

    public function __construct(Transporte $transporte){
        $this->transporte = $transporte;
    }

    public function index(){
        $transporte = $this->transporte->all();

        return response()->json($transporte);
    }

    // http://localhost/laravel/api/transportes/paginate?page=2
    public function paginate(){
        $transporte = $this->transporte->paginate(1);

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
