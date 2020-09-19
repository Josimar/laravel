<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Requests\ImovelFotoRequest;
use App\Http\Resources\ImovelFotoCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ImovelFotoInterface;
use Illuminate\Support\Facades\Storage;

class ImovelFotoController extends Controller{

    private $model;

    public function __construct(ImovelFotoInterface $model){
        $this->model = $model;
    }

    public function setThumb($fotoid, $imovelid){
        try{
            $foto = $this->model
                ->where('imovelid', $imovelid)
                ->where('thumb', true);

            if ($foto->count()){
                $foto->first()->update(['thumb' => false]);
            }

            $foto = $this->model->find($fotoid);
            $foto->update(['thumb'=>true]);

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
            $foto = $this->model->find($id);

            if ($foto->thumb){
                $message = new ApiMessages('Registry marked with thumb');
                return response()->json(['error' => $message->getMessage()], 401);
            }

            if ($foto){
                Storage::disk('public')->delete($foto->foto);
                $foto->delete();
            }

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
