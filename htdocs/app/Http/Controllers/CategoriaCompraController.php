<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\CategoriaCompraInterface;
use Illuminate\Support\Str;

class CategoriaCompraController
{
    private $rota = 'categoriacompra';
    private $model;
    private $colunas;

    public function __construct(CategoriaCompraInterface $model){
        $this->model = $model;
        $this->colunas = ['id'=>'#', 'descricao'=>trans('controle.description')];
    }

    public function treeview(Request $request){
        return response()->json(['message'=>__METHOD__]);
    }

    public function index(Request $request){
        // return response()->json(['message'=>__METHOD__]);

        // usuário logado
        $usuario = auth()->user();

        /* ToDo: Permissão
        if (Gate::denies($routeName.'-index')){
            abort(403, 'Não Autorizado');
        }
        */

        $titulo = trans('controle.category');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $categorias = $usuario->categoriacompra; // $this->model->all();
        $categoria = '';
        $orderlist = "";
        $tableNomeIdList = [];

        return view($routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'categorias', 'categoria', 'tableNomeIdList', 'orderlist'));
    }

    public function create()
    {
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.category');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.create').' '.$titulo],
        ];
        $search = "";
        $orderlist = "";
        $categorias = new Collection;
        $categoria = '';
        $tableNomeIdList = [];

        return view($routeName.'.create', compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'categorias', 'categoria', 'tableNomeIdList', 'orderlist'));
    }

    public function edit($id)
    {
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.category');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.create').' '.$titulo],
        ];
        $search = "";
        $orderlist = "";
        $categorias = new Collection;
        $categoria = $this->model->find($id);
        $tableNomeIdList = [];

        return view($routeName.'.edit', compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'categorias', 'categoria', 'tableNomeIdList', 'orderlist'));
    }

    public function addCategoria(Request $request){
        return response()->json(['message'=>__METHOD__]);
        // dd($request->all());
    }

    public function store(Request $request){
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        // usuário logado
        $usuario = auth()->user();

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $data = $request->all();

        // usuário logado
        $usuario = auth()->user();
        // dd($usuario);

        Validator::make($data, [
            'descricao' => 'required|string|max:255'
        ])->validate();

        $routeName = $this->rota;

        if (isset($data['categoriaid1']) && $data['categoriaid1'] != ""){
            $data['categoriaid'] = $data['categoriaid1'];
            $request->merge($data);
        }
        if (isset($data['categoriaid2']) && $data['categoriaid2'] != ""){
            $data['categoriaid'] = $data['categoriaid2'];
            $request->merge($data);
        }
        if (isset($data['categoriaid3']) && $data['categoriaid3'] != ""){
            $data['categoriaid'] = $data['categoriaid3'];
            $request->merge($data);
        }
        $data['slug'] = Str::slug($request->descricao);

        $categoria = $this->model->save($data);

        if ($categoria != null && $categoria != ""){
            $categoria->usuarios()->attach($usuario);

            session()->flash('msgMessage', trans('controle.add_success'));
            session()->flash('msgStatus', 'success');
            return redirect(route($routeName.'.index'));
        }else{
            session()->flash('msgMessage', trans('controle.add_error'));
            session()->flash('msgStatus', 'error');
            return redirect(route($routeName.'.create'));
        }
    }

    public function show($id){
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.category');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.create').' '.$titulo],
        ];
        $search = "";
        $orderlist = "";
        $categorias = new Collection;
        $categoria = $this->model->find($id);
        $tableNomeIdList = [];
        $delete = '1';

        return view($routeName.'.show', compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'categorias', 'categoria', 'tableNomeIdList', 'orderlist', 'delete'));
    }

    public function findchild($id){
        return response()->json(['message'=>__METHOD__]);
    }

    public function update(Request $request, $id)
    {
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        // usuário logado
        $usuario = auth()->user();

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $routeName = $this->rota;
        $data = $request->all();

        Validator::make($data, [
            'descricao' => 'required|string|max:255'
        ])->validate();

        if ($this->model->update($data, $id)){
            session()->flash('msgMessage', trans('controle.edit_success'));
            session()->flash('msgStatus', 'success');
            return redirect(route($routeName.'.index'));
        }else{
            session()->flash('msgMessage', trans('controle.edit_error'));
            session()->flash('msgStatus', 'error');
            return redirect(route($routeName.'.edit'));
        }
    }

    public function atualizar(Request $request){
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        // usuário logado
        $usuario = auth()->user();

        $routeName = $this->rota;
        $data = $request->all();

        Validator::make($data, [
            'categoriaid' => 'required',
            'categoriaidpai' => 'required',
        ])->validate();

        $idcategpai = $request->categoriaidpai ?? 0;
        $categoriapai = $this->model->find($idcategpai);

        $idcateg = $request->categoriaid ?? 0;
        $categoria = $this->model->find($idcateg);

        $categoria->usuarios()->attach($usuario);

        $nivel = $categoriapai->nivel + 1;

        $categoria->categoriaid = $idcategpai;
        $categoria->nivel = $nivel;

        if ($this->model->update(['categoriaid' => $idcategpai, 'nivel' => $nivel], $idcateg)){
            session()->flash('msgMessage', trans('controle.edit_success'));
            session()->flash('msgStatus', 'success');
            return redirect(route($routeName.'.treeview'));
        }else{
            session()->flash('msgMessage', trans('controle.edit_error'));
            session()->flash('msgStatus', 'error');
            return redirect(route($routeName.'.treeview'));
        }
    }

    public function destroy($id)
    {
        // return response()->json(['message'=>__METHOD__]);

        $routeName = $this->rota;
        $ret = $this->model->delete($id);
        if ($ret){
            session()->flash('msgMessage', trans('controle.delete_success'));
            session()->flash('msgStatus', 'success');
            return redirect()->route($routeName.'.index');
        }else{
            session()->flash('msgMessage', trans('controle.delete_error'));
            session()->flash('msgStatus', 'error');
            return redirect()->back();
        }

    }
}
