<?php


namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\ProdutoInterface;
use App\Repositories\Contracts\CategoriaInterface;
use App\Repositories\Contracts\ListaInterface;

class ProdutoController
{
    private $rota = 'produtos';
    private $model;
    private $modelLista;
    private $modelCategoria;
    private $colunas;

    public function __construct(ProdutoInterface $model, CategoriaInterface $modelCategoria, ListaInterface $modelLista){
        $this->model = $model;
        $this->modelLista = $modelLista;
        $this->modelCategoria = $modelCategoria;

        $this->colunas = ['id'=>'#',
            'nome'=>trans('controle.name'),
            'quantidade'=>trans('controle.quantity'),
            'unidade'=>trans('controle.unit'),
            'valor'=>trans('controle.value'),
            'precisao'=>trans('controle.precision')];
    }

    public function index(Request $request){
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies($routeName.'-index')){
            abort(403, 'Não Autorizado');
        }
        */

        $titulo = trans('controle.product');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $produtos = $this->model->all();
        $produto = '';

        return view($routeName.'.index',
            compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'produtos', 'produto'));
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
        $titulo = trans('controle.product');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.create').' '.$titulo],
        ];
        $search = "";
        $registros = new Collection;
        $registro = '';

        $listas = $this->modelLista->all('nome', 'ASC');
        $categorias = $this->modelCategoria->all('descricao', 'ASC');


        return view($routeName.'.create',
            compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'listas', 'categorias'));
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

        // valor default de quantidade
        if (!isset($data['quantidade']) || $data['quantidade'] == ""){
            $data['quantidade'] = '0';
            $request->merge($data);
        }
        // valor default de valor
        if (!isset($data['valor']) || $data['valor'] == ""){
            $data['valor'] = '0';
            $request->merge($data);
        }
        // valor default de unidade
        if (!isset($data['unidade']) || $data['unidade'] == ""){
            $data['unidade'] = 'unidade';
            $request->merge($data);
        }
        // valor default de precisao
        if (!isset($data['precisao']) || $data['precisao'] == ""){
            $data['precisao'] = '0';
            $request->merge($data);
        }

        Validator::make($data, [
            'usuarioid' => 'required|string',
            'listaid' => 'required|string',
            'categoriaid' => 'required|string',
            'nome' => 'required|string|max:255',
        ])->validate();

        dd($data);
    }
}
