<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Http\Resources\UsuarioCollection;
use App\Repositories\Contracts\UsuarioInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $model;

    public function __construct(UsuarioInterface $model){
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $this->model->selectCondition($request);
        $this->model->selectFilter($request);
        $usuario = $this->model->getResult();

        // return response()->json($usuario);
        return new UsuarioCollection($usuario->paginate(10));
    }

    // http://localhost/laravel/api/usuarios/paginate?page=1
    public function paginate(){
        $usuario = $this->model->paginate(10);

        // return response()->json($usuario);
        return new UsuarioCollection($usuario);
    }

    public function show($id){
        try{
            $usuario = $this->model->find($id);

            $usuario->profile->redes = unserialize($usuario->profile->redes);

            return response()->json([
                'data' => $usuario
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }

        // return new UsuarioCollection($usuario);
    }

    // No Header precisa -> Accept => application/json
    public function save(UsuarioRequest $request){
        $data = $request->all();

        if (!$request->has('password') || !$request->get('password')){
            $message = new ApiMessages('Password required');
            return response()->json(['error' => $message->getMessage()], 401);
        }

        Validator::make($data, [
            'fone' => 'required',
            'sobre' => 'required'
        ])->validate();

        try{
            $data['password'] = Hash::make($data['password']);
            $usuario = $this->model->save($data);

            $usuario->profile()->create(
              [
                  'fone' => $data['fone'],
                  'sobre' => $data['sobre']
              ]
            );

            return response()->json([
                'data' => [
                    'msg' => 'Registry add with success',
                    'data' => $usuario
                ]
            ], 200);
        }catch (\Exception $ex){
            $message = new ApiMessages($ex->getMessage());
            return response()->json(['error' => $message->getMessage()], 401);
        }
    }

    public function update($id, UsuarioRequest $request){
        $data = $request->all();

        if (!$request->has('password') && !$request->get('password')){
            $data['password'] = Hash::make($data['password']);
        }else{
            unset($data['password']);
        }

        unset($data['email']);

        Validator::make($data, [
            'profile.fone' => 'required',
            'profile.sobre' => 'required'
        ])->validate();

        try{
            $profile = $data['profile'];
            $profile['redes'] = serialize($profile['redes']);

            $usuario = $this->model->find($id);
            $usuario->update($data);

            $usuario->profile()->update($profile);

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
            $usuario = $this->model->find($id);
            $usuario->delete();

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
