<?php


namespace App\Http\Controllers;

use App\Api\ApiMessages;
use App\Repositories\Contracts\SistemaInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\ProdutoInterface;
use App\Repositories\Contracts\CategoriaInterface;
use App\Repositories\Contracts\ListaInterface;

class ProdutoController
{
    private $rota = 'produtos';
    private $sistema = 'lista-de-compras';
    private $model;
    private $modelLista;
    private $modelCategoria;
    private $modelSistema;
    private $colunas;

    public function __construct(ProdutoInterface $model, CategoriaInterface $modelCategoria,
                                ListaInterface $modelLista, SistemaInterface $modelSistema){
        $this->model = $model;
        $this->modelLista = $modelLista;
        $this->modelCategoria = $modelCategoria;
        $this->modelSistema = $modelSistema;

        $this->colunas = ['id'=>'#',
            'nome'=>trans('controle.name'),
            'categoria->descricao'=>trans('controle.category'),
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
        $orderlist = "";
        $produtos = $this->model->all(); // dd($produtos[2]->categoria->descricao);
        $produto = '';
        $tableNomeIdList = [
            ['tabela'=>'lista', 'id'=>0, 'descricao'=>'']
        ];

        return view($routeName.'.index',
            compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'produtos', 'produto', 'tableNomeIdList', 'orderlist'));
    }

    public function show($id){
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies($routeName.'-index')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.product');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.detail').' '.$titulo],
        ];
        $search = "";
        $orderlist = "";
        $delete = $request->delete ?? '0';
        $produtos = new Collection;
        $produto = $this->model->find($id);
        $tableNomeIdList = [
            ['tabela'=>'lista', 'id'=>0, 'descricao'=>'']
        ];

        return view($routeName.'.show', compact('delete', 'routeName', 'titulo', 'search', 'caminhos', 'colunas', 'produtos', 'produto', 'tableNomeIdList', 'orderlist'));
    }

    public function edit($id){
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
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.edit').' '.$titulo],
        ];

        $search = "";
        $orderlist = "";
        $produtos = new Collection;
        $produto = $this->model->find($id);
        $tableNomeIdList = [
            ['tabela'=>'lista', 'id'=>0, 'descricao'=>'']
        ];

        return view($routeName.'.edit', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'produtos', 'produto', 'tableNomeIdList', 'orderlist'));
    }

    public function create($listaid)
    {
        // return response()->json(['message'=>__METHOD__]);

        // usuário logado
        $usuario = auth()->user();

        // recupera o id do sistema
        $this->modelSistema->selectConditionVariable('slug', '=', $this->sistema);
        $sistema = $this->modelSistema->getResult()->get()[0];

        // $sistema = $this->modelSistema->findFieldModel('slug', '=', $this->sistema);

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
        $orderlist = "";
        $registros = new Collection;
        $registro = '';

        $listas = $usuario->listascompra;

        $categoriasUser = $usuario->categorias;
        $categoriasSystem = $sistema->categorias;

        $categorias = new Collection;
        foreach ($categoriasSystem as $categsystem) {
            $categorias->add($categoriasUser->find($categsystem->id));
        }

        $tableNomeIdList = [
            ['tabela'=>'lista', 'id'=>$listaid, 'descricao'=>'']
        ];

        return view($routeName.'.create',
            compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist', 'listas', 'categorias'));
    }

    public function store(Request $request){
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        // usuário logado
        $usuario = auth()->user();
        // dd($usuario);

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $data = $request->all();

        $data['usuarioid'] = $usuario->id;

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
            $data['unidade'] = 'un';
            $request->merge($data);
        }
        // valor default de precisao
        if (!isset($data['precisao']) || $data['precisao'] == ""){
            $data['precisao'] = '0';
            $request->merge($data);
        }

        $listaid = $data['listaid'];

        Validator::make($data, [
            'usuarioid' => 'required',
            'listaid' => 'required',
            'categoriaid' => 'required',
            'nome' => 'required|string|max:255',
        ])->validate();

        $routeName = $this->rota;

        // dd($data);
        if ($this->model->create($data)){
            session()->flash('msgMessage', trans('controle.add_success'));
            session()->flash('msgStatus', 'success');
            return redirect(route('produtos.lista', $listaid));
        }else{
            session()->flash('msgMessage', trans('controle.add_error'));
            session()->flash('msgStatus', 'error');
            return redirect(route('produtos.create.lista', $listaid));
        }
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
        $produtos = $this->model->findField('listaid', '=', $lista->id);

        $titulo = trans('controle.product');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $produto = '';
        $orderlist = "";
        $tableNomeIdList = [
            ['tabela'=>'categoria', 'id'=>$lista->id, 'descricao'=>''],
            ['tabela'=>'lista', 'id'=>$lista->id, 'descricao'=>'']
        ];

        return view($routeName.'.index',
            compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'produtos', 'produto', 'tableNomeIdList', 'orderlist'));
    }
}
