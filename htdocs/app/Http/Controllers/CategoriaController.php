<?php


namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\CategoriaInterface;

class CategoriaController
{
    private $rota = 'categorias';
    private $model;
    private $colunas;

    public function __construct(CategoriaInterface $model){
        $this->model = $model;
        $this->colunas = ['id'=>'#',
            'categoriaid'=>trans('controle.categoriaid'),
            'descricao'=>trans('controle.description')];
    }

    public function index(Request $request){
        // return response()->json(['message'=>__METHOD__]);

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
        $categorias = $this->model->all();
        $categoria = '';

        return view($routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'categorias', 'categoria'));
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
        $categorias = new Collection;
        $categoria = '';

        return view($routeName.'.create', compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'categorias', 'categoria'));
    }

    public function store(Request $request){
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $data = $request->all();

        Validator::make($data, [
            'usuarioid' => 'required|string',
            'nome' => 'required|string|max:255',
        ])->validate();

        dd($data);
    }
}
