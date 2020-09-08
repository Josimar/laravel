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
        $this->page = trans('controle.tarefas'); // ToDo: tradução error
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

        $request->session()->flash('status', 'Task was successful');

        return view($routeName.'.index', compact('tarefas', 'caminhos', 'search', 'routeName', 'page', 'link', 'columnList'));
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

        return view($routeName.'.create', compact('tarefas', 'caminhos', 'search', 'routeName', 'page', 'link', 'columnList'));
    }

    public function store(Request $request)
    {
        // return response()->json(['message'=>__METHOD__]);
        dd($request->all());
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
