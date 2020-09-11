<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\RepositoryInterface;

class TarefaController extends Controller
{
    private $rota = 'tarefas';
    private $model;
    private $page;
    private $paginate = 10;
    private $filtro = ['titulo', 'descricao'];

    public function __construct(RepositoryInterface $model){
        $this->page = trans('controle.tarefas');
        $this->model = $model;
    }

    public function index(Request $request)
    {
        // return response()->json(['message'=>__METHOD__]);

        $routeName = $this->rota;

        /* ToDo: Permissão
        if (Gate::denies($routeName.'-view')){
            abort(403, 'Não Autorizado');
        }
        */

        $columnList = ['id'=>'#',
            'titulo'=>trans('controle.titulo'),
            'descricao'=>trans('controle.descricao'),
            'progresso'=>trans('controle.progresso'),
            'percentcomplete'=>trans('controle.percentual')];

        $page = $this->page;
        $search = "";
        $link = $routeName.'-view';

        if (isset($request->search)){
            $search = $request->search;
            $tarefas = $this->model->findWhereLike($this->filtro, $search, 'id', 'DESC');
        }else{
            $tarefas = $this->model->paginate($this->paginate);
        }

        $caminhos = [
            ['url'=>'../admin', 'titulo'=>'Admin'],
            ['url'=>'', 'titulo'=>$page],
        ];

        $tarefa  = ''; $msgMessage = ''; $msgStatus = ''; $delete = '';

        return view($routeName.'.index', compact('page','search', 'caminhos', 'routeName', 'delete', 'columnList', 'tarefas', 'tarefa', 'msgMessage', 'msgStatus'));
    }

    public function create()
    {
        // return response()->json(['message'=>__METHOD__]);

        $routeName = $this->rota;
        $page = $this->page;
        $search = "";
        $link = $routeName.'-create';
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('tarefas.index'), 'titulo'=>$page],
            ['url'=>'', 'titulo'=>trans('controle.create_crud', ['page'=>$page])],
        ];
        $columnList = [];
        $tarefas = new LengthAwarePaginator(null, 0, 1);
        $tarefa  = ''; $msgMessage = ''; $msgStatus = ''; $delete = '';

        return view($routeName.'.create', compact('page','search', 'caminhos', 'routeName', 'delete', 'columnList', 'tarefas', 'tarefa', 'msgMessage', 'msgStatus'));
    }

    public function store(Request $request)
    {
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        $data = $request->all();
        Validator::make($data, [
            'titulo' => 'required|string|max:64',
            'descricao' => 'required|string|max:255',
        ])->validate();

        if ($this->model->create($data)){
            session()->flash('msgMessage', trans('controle.add_success'));
            session()->flash('msgStatus', 'success');
            $msgMessage = trans('controle.add_success');
            $msgStatus = 'success';
            return redirect()->back()->with(compact('msgMessage', 'msgStatus'));
        }else{
            session()->flash('msgMessage', trans('controle.add_error'));
            session()->flash('msgStatus', 'error');
            $msgMessage = trans('controle.add_error');
            $msgStatus = 'error';
            return redirect()->back()->with(compact('msgMessage', 'msgStatus'));
        }
    }

    public function show($id, Request $request)
    {
        // return response()->json(['message'=>__METHOD__]);
        $routeName = $this->rota;
        $page = $this->page;
        $search = "";
        $link = $routeName.'-show';
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('tarefas.index'), 'titulo'=>$page],
            ['url'=>'', 'titulo'=>trans('controle.show_crud', ['page'=>$page])],
        ];
        $columnList = [];

        // $tarefa = $this->model->findPaginate($this->paginate, $id);
        $tarefa = $this->model->find($id);
        $tarefas = new LengthAwarePaginator(null, 0, 1);

        if (!$tarefa){
            return redirect()->route($routeName.'index');
        }

        $delete = $request->delete ?? '0';
        $msgMessage = ''; $msgStatus = '';
        if ($delete){
            $msgMessage = 'Deseja apagar o registro?'; $msgStatus = 'notification';
        }

        return view($routeName.'.show', compact('page','search', 'caminhos', 'routeName', 'delete', 'columnList', 'tarefas', 'tarefa', 'msgMessage', 'msgStatus'));
    }

    public function edit($id)
    {
        // return response()->json(['message'=>__METHOD__]);

        $routeName = $this->rota;
        $page = $this->page;
        $search = "";
        $link = $routeName.'-edit';
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('tarefas.index'), 'titulo'=>$page],
            ['url'=>'', 'titulo'=>trans('controle.edit_crud', ['page'=>$page])],
        ];
        $columnList = [];

        // $tarefa = $this->model->findPaginate($this->paginate, $id);
        $tarefa = $this->model->find($id);
        $tarefas = new LengthAwarePaginator(null, 0, 1);

        if (!$tarefa){
            return redirect()->route($routeName.'index');
        }

        $msgMessage = ''; $msgStatus = ''; $delete = '';
        return view($routeName.'.edit', compact('page','search', 'caminhos', 'routeName', 'delete', 'columnList', 'tarefas', 'tarefa', 'msgMessage', 'msgStatus'));
    }

    public function update(Request $request, $id)
    {
        // return response()->json(['message'=>__METHOD__]);
        $data = $request->all();
        Validator::make($data, [
            'titulo' => 'required|string|max:64',
            'descricao' => 'required|string|max:255',
        ])->validate();
        $ret = $this->model->update($data, $id);
        if ($ret){
            session()->flash('msgMessage', trans('controle.edit_success'));
            session()->flash('msgStatus', 'success');
            $msgMessage = trans('controle.edit_success');
            $msgStatus = 'success';
            return redirect()->back()->with(compact('msgMessage', 'msgStatus'));
        }else{
            session()->flash('msgMessage', trans('controle.edit_error'));
            session()->flash('msgStatus', 'error');
            $msgMessage = trans('controle.edit_error');
            $msgStatus = 'error';
            return redirect()->back()->with(compact('msgMessage', 'msgStatus'));
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
            $msgMessage = trans('controle.delete_success');
            $msgStatus = 'success';
            return redirect()->back()->with(compact('msgMessage', 'msgStatus'));
        }else{
            session()->flash('msgMessage', trans('controle.delete_error'));
            session()->flash('msgStatus', 'error');
            $msgMessage = trans('controle.delete_error');
            $msgStatus = 'error';
            return redirect()->route($routeName.'.index')->with(compact('msgMessage', 'msgStatus'));
        }

    }
}
