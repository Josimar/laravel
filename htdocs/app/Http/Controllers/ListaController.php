<?php


namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\ListaInterface;

class ListaController
{
    private $rota = 'listas';
    private $model;
    private $colunas;

    public function __construct(ListaInterface $model){
        $this->model = $model;
        $this->colunas = ['id'=>'#', 'nome'=>trans('controle.name')];
    }

    public function index(Request $request){
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies($routeName.'-index')){
            abort(403, 'Não Autorizado');
        }
        */

        $titulo = trans('controle.list');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $listas = $this->model->all();
        $lista = '';

        return view($routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'listas', 'lista'));
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
        $titulo = trans('controle.list');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.create').' '.$titulo],
        ];

        $search = "";
        $listas = new Collection;
        $lista = '';

        return view($routeName.'.create', compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'listas', 'lista'));
    }

    public function store(Request $request){
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $routeName = $this->rota;
        $data = $request->all();

        Validator::make($data, [
            'usuarioid' => 'required|string',
            'nome' => 'required|string|max:255',
        ])->validate();

        if ($this->model->create($data)){
            session()->flash('msgMessage', trans('controle.add_success'));
            session()->flash('msgStatus', 'success');
            return redirect(route($routeName.'.create'));
        }else{
            session()->flash('msgMessage', trans('controle.add_error'));
            session()->flash('msgStatus', 'error');
            return redirect(route($routeName.'.create'));
        }
    }

    public function edit($id){
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies($routeName.'-index')){
            abort(403, 'Não Autorizado');
        }
        */

        $titulo = trans('controle.list');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.edit').' '.$titulo],
        ];

        $search = "";
        $listas = new Collection;
        $lista = $this->model->find($id);

        return view($routeName.'.edit', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'listas', 'lista'));
    }

    public function update(Request $request, $id)
    {
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $routeName = $this->rota;
        $data = $request->all();

        Validator::make($data, [
            'usuarioid' => 'required|string',
            'nome' => 'required|string|max:255',
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

    public function show($id, Request $request){
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies($routeName.'-index')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.list');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.detail').' '.$titulo],
        ];
        $search = "";
        $delete = $request->delete ?? '0';
        $listas = new Collection;
        $lista = $this->model->find($id);

        return view($routeName.'.show', compact('delete', 'routeName', 'titulo', 'search', 'caminhos', 'colunas', 'listas', 'lista'));
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
