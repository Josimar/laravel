<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function save(Request $request){
        return response()->json($request->all());
    }

}
