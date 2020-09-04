<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\RepositoryInterface;

class TarefaController extends Controller
{
    private $rota = 'tarefas';
    private $model;
    private $page;
    private $paginate = 10;
    private $filtro = ['titulo', 'descricao'];

    public function __construct(RepositoryInterface $model){
        $this->page = trans('Tarefas');
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

        $columnList = ['id'=>'#', 'tarefa'=>trans('controle.tarefa'), 
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

        $request->session()->flash('status', 'Task was successful');

        return view($routeName.'.index', compact('tarefas', 'caminhos', 'search', 'routeName', 'page', 'link', 'columnList'));
    }

    public function create()
    {
        return response()->json(['message'=>__METHOD__]);
    }

    public function store(Request $request)
    {
        return response()->json(['message'=>__METHOD__]);
    }

    public function show($id)
    {
        return response()->json(['message'=>__METHOD__]);
    }

    public function edit($id)
    {
        return response()->json(['message'=>__METHOD__]);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message'=>__METHOD__]);
    }

    public function destroy($id)
    {
        return response()->json(['message'=>__METHOD__]);
    }
}
