<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProdutoRequest;
use App\Http\Resources\ProdutoCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProdutoCompraInterface;
use Illuminate\Support\Facades\DB;


class ProdutoCompraController extends Controller{

    private $model;

    public function __construct(ProdutoCompraInterface $model){
        $this->model = $model;
    }

    // http://localhost/laravel/api/produtos?fields=nome,quantidade&conditions=nome:LIKE:%a%
    public function index(Request $request){
        // usuário logado
        $usuario = auth()->user();

        $this->model->selectCondition($request, $usuario);
        $this->model->selectFilter($request);
        $produto = $this->model->getResult();

        if (get_class($produto) == "Illuminate\Database\Eloquent\Collection"){
            return new ProdutoCollection(\App\Helpers\CollectionHelper::paginate($produto->sortBy('descricao'), 10));
        }else if (get_class($produto) == "App\Model\ProdutoCompra"){
            return new ProdutoCollection($produto->paginate(10));
        }

        return response()->json($produto);
    }

    // http://localhost/laravel/api/produtos/paginate?page=1
    public function paginate(){
        $produto = $this->model->paginate(10);

        // return response()->json($produto);
        return new ProdutoCollection($produto);
    }

    public function show($id){
        $produto = $this->model->find($id);

        // return response()->json($produto);
        return new ProdutoCollection($produto);
    }

    // No Header precisa -> Accept => application/json
    public function save(ProdutoRequest $request){
        $data = $request->all();

        // valor default de valor
        if (!isset($data['valor']) || $data['valor'] == ""){
            $data['valor'] = '0';
            $request->merge($data);
        }else{
            $valor = $data['valor'];
            $valor = str_replace('R', "", $valor);
            $valor = str_replace('$', "", $valor);
            $valor = str_replace('.', "", $valor);
            $valor = str_replace(',', ".", $valor);
            $data['valor'] = $valor;
        }
        // valor default de quantidade
        if (!isset($data['quantidade']) || $data['quantidade'] == ""){
            $data['quantidade'] = '0';
            $request->merge($data);
        }
        // valor default de unidade
        if (!isset($data['unidade']) || $data['unidade'] == ""){
            $data['unidade'] = 'un';
            $request->merge($data);
        }
        // valor default de precisao
        if (!isset($data['precisao']) || $data['precisao'] == ""){
            $data['precisao'] = '0';
            $request->merge($data);
        }
        // ordem default de precisao
        if (!isset($data['ordem']) || $data['ordem'] == ""){
            $data['ordem'] = '0';
            $request->merge($data);
        }
        // valor default de categoriaid
        if (!isset($data['categoriaid']) || $data['categoriaid'] == ""){
            $data['categoriaid'] = '0';
            $request->merge($data);
        }else{
            $categoriaid = $data['categoriaid'];
            if ($categoriaid == null || $categoriaid == 'null'){
                $data['categoriaid'] = '0';
            }
        }
        // valor default de listaid
        $listaid = 0;
        if (!isset($data['listaid']) || $data['listaid'] == ""){
            $data['listaid'] = '0';
            $request->merge($data);
        }else{
            $listaid = $data['listaid'];
            if ($listaid == null || $listaid == 'null'){
                $data['listaid'] = '0';
            }
        }

        $produtos = $this->model->findField('listaid', '=', $listaid, 'ordem', 'DESC');
        if (is_null($produtos)){
            $data['ordem'] = '0';
        }else{
            $data['ordem'] = $produtos[0]->ordem + 1;
        }

        // usuário logado
        $usuario = auth()->user();
        // dd($usuario);

        $data['usuarioid'] = $usuario->id;

        $produto = $this->model->save($data);

        return response()->json($produto);
    }

    public function update(ProdutoRequest $request, $id){
        // return response()->json(['message'=>__METHOD__]);
        // dd($request);

        $data = $request->all();

        $produto = $this->model->find($id);
        $produto->update($data);

        return response()->json($produto);
    }

    public function delete($id){
        $produto = $this->model->find($id);
        $produto->delete();

        return response()->json(['data'=>['msg'=>'Registry deleted']]);
    }

    public function lista(Request $request, $id){
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());
        // dd($id);

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        // usuário logado
        $usuario = auth()->user();
        // dd($usuario);

        // pego a lista atual
        $lista = $usuario->listascompra()->find($id);
        // dd($lista);

        // produtos da lista
        $produtos = $this->model->findFieldModel('listaid', '=', $lista->id, 'ordem', 'ASC');
        // dd($produtos);

        return new ProdutoCollection($produtos->paginate(10));
    }

    public function order(Request $request, $listaid, $produtoid, $order){
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());
        // dd($listaid);
        // dd($produtoid);
        // dd($order);

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        // usuário logado
        $usuario = auth()->user();
        // dd($usuario);

        $produto = $this->model->find($produtoid);
        // dd($produto);
        $ordem = $produto->ordem;

        $produtos = $this->model->findField('listaid', '=', $listaid, 'ordem', 'ASC');
        $contador = 0;

        foreach ($produtos as $p) {
            $contador = $contador + 1;

            if ($order > $ordem){
               if ($p->id == $produto->id){
                   $contador = $contador - 1;
                   $p->ordem = $order;
                   $p->save();
               }else if ($contador == $order){
                   $contador = $contador + 1;
                   $p->ordem = $contador;
                   $p->save();
               }else{
                   $p->ordem = $contador;
                   $p->save();
               }
            }else if ($order < $ordem){
                if ($p->id == $produto->id){
                    $contador = $contador - 1;
                    $p->ordem = $order;
                    $p->save();
                }else if ($contador == $order){
                    $contador = $contador + 1;
                    $p->ordem = $contador;
                    $p->save();
                }else{
                    $p->ordem = $contador;
                    $p->save();
                }
            }
        }

        if (get_class($produtos) == "Illuminate\Database\Eloquent\Collection"){
            return new ProdutoCollection(\App\Helpers\CollectionHelper::paginate($produtos->sortBy('descricao'), 10));
        }else if (get_class($produtos) == "App\Model\ProdutoCompra"){
            return new ProdutoCollection($produtos->paginate(10));
        }

        return response()->json($produtos);
    }

}
