<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;


class TarefaController extends Controller{

    public function index(){
        try{
            $tarefa = 'Tarefa';

            return response()->json([
                'data' => $tarefa
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }


}
