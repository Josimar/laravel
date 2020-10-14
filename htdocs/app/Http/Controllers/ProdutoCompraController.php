<?php


namespace App\Http\Controllers;

use App\Api\ApiMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\SistemaInterface;
use App\Repositories\Contracts\CategoriaInterface;
use App\Repositories\Contracts\ListaCompraInterface;
use App\Repositories\Contracts\ProdutoCompraInterface;

class ProdutoCompraController
{
    private $view = 'listaproduto';
    private $rota = 'produtocompra';
    private $sistema = 'lista-de-compras';
    private $model;
    private $modelLista;
    private $modelCategoria;
    private $modelSistema;
    private $colunas;

    public function __construct(ProdutoCompraInterface $model, CategoriaInterface $modelCategoria,
                                ListaCompraInterface $modelLista){
        $this->model = $model;
        $this->modelLista = $modelLista;
        $this->modelCategoria = $modelCategoria;

        $this->colunas = ['id'=>'#',
            'nome'=>trans('controle.name'),
            'categoria->descricao'=>trans('controle.category'),
            'quantidade'=>trans('controle.quantity'),
            'unidade'=>trans('controle.unit'),
            'valor'=>trans('controle.value'),
            'precisao'=>trans('controle.precision'),
            'ordem'=>trans('controle.ordem')];
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

        $titulo = trans('controle.product');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $orderlist = "";
        $produtos = $usuario->produtocompra;
        // $produtos = $this->model->all()->sortBy("ordem"); // dd($produtos[2]->categoria->descricao);
        $produto = '';
        $tableNomeIdList = [
            ['tabela'=>'lista', 'id'=>0, 'descricao'=>'']
        ];

        return view($this->view.'.index',
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

        return view($this->view.'.show', compact('delete', 'routeName', 'titulo', 'search', 'caminhos', 'colunas', 'produtos', 'produto', 'tableNomeIdList', 'orderlist'));
    }

    public function edit($id){
        // return response()->json(['message'=>__METHOD__]);

        // usuário logado
        $usuario = auth()->user();

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

        $listas = $usuario->listascompra;
        $categorias = $usuario->categoriacompra;

        $tableNomeIdList = [
            ['tabela'=>'lista', 'id'=>0, 'descricao'=>'']
        ];

        return view($this->view.'.edit', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'produtos', 'produto', 'tableNomeIdList', 'listas', 'categorias', 'orderlist'));
    }

    public function create($listaid)
    {
        // return response()->json(['message'=>__METHOD__]);

        // usuário logado
        $usuario = auth()->user();

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

        /* Pego a categoria do usuário e a do sistema e exibo as com permissão
        $categoriasUser = $usuario->categorias;
        $categoriasSystem = $sistema->categorias;

        $categorias = new Collection;
        foreach ($categoriasSystem as $categsystem) {
            $categorias->add($categoriasUser->find($categsystem->id));
        }
        */
        $categorias = $usuario->categoriacompra;

        $tableNomeIdList = [
            ['tabela'=>'lista', 'id'=>$listaid, 'descricao'=>'']
        ];

        return view($this->view.'.create',
            compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'listas', 'categorias', 'orderlist'));
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
            $data['unidade'] = 'unidade';
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

        $listaid = $data['listaid'];

        Validator::make($data, [
            'usuarioid' => 'required',
            'listaid' => 'required',
            'categoriaid' => 'required',
            'nome' => 'required|string|max:255',
        ])->validate();

        $produtos = $this->model->findField('listaid', '=', $listaid, 'ordem', 'DESC');
        if (is_null($produtos) || $produtos->count() == 0){
            $data['ordem'] = '0';
        }else{
            $data['ordem'] = $produtos[0]->ordem + 1;
        }

        // dd($data);
        if ($this->model->create($data)){
            session()->flash('msgMessage', trans('controle.add_success'));
            session()->flash('msgStatus', 'success');
            return redirect(route('produtocompra.lista', $listaid));
        }else{
            session()->flash('msgMessage', trans('controle.add_error'));
            session()->flash('msgStatus', 'error');
            return redirect(route('produtocompra.create.lista', $listaid));
        }
    }

    public function update(Request $request, $id){
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
            $data['unidade'] = 'unidade';
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

        // dd($data);
        if ($this->model->update($data, $id)){
            session()->flash('msgMessage', trans('controle.edit_success'));
            session()->flash('msgStatus', 'success');
            return redirect(route('produtocompra.lista', $listaid));
        }else{
            session()->flash('msgMessage', trans('controle.edit_error'));
            session()->flash('msgStatus', 'error');
            return redirect(route('produtocompra.create.lista', $listaid));
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
        if (! $lista){
            abort(403, 'Não Autorizado');
        }

        // produtos da lista
        $produtos = $this->model->findField('listaid', '=', $lista->id, 'ordem', 'ASC');

        $titulo = trans('controle.product');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $orderlist = "true";
        $search = "";
        $produto = '';
        $tableNomeIdList = [
            ['tabela'=>'categoria', 'id'=>$lista->id, 'descricao'=>''],
            ['tabela'=>'lista', 'id'=>$lista->id, 'descricao'=>'']
        ];

        return view($this->view.'.index',
            compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'produtos', 'produto', 'tableNomeIdList', 'orderlist'));
    }

    public function order(Request $request, $listaid, $produtoid, $direction)
    {
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());
        // dd($listaid);
        // dd($produtoid);
        // dd($direction);

        // usuário logado
        $usuario = auth()->user();
        // dd($usuario);

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $produto = $this->model->find($produtoid);
        $ordem = $produto->ordem;

        $produtos = $this->model->findField('listaid', '=', $listaid, 'ordem', 'ASC');
        $contador = 0;

        if ($ordem == 0){
            if ($direction == 'down'){
                foreach ($produtos as $p) {
                  $contador = $contador + 1;
                  $p->ordem = $contador;
                  $p->save();
                }
                $produto->ordem = 0;
                $produto->save();
            }else{
                foreach ($produtos as $p) {
                    $contador = $contador + 1;
                    $p->ordem = $contador;
                    $p->save();
                }
                $produto->ordem = $contador + 1;;
                $produto->save();
            }
        }else{
            if ($direction == 'down'){
                foreach ($produtos as $p) {
                    $contador = $contador + 1;
                    if ($contador == ($ordem - 1)){
                        $p->ordem = $contador + 1;
                        $p->save();
                    }else if ($p->id == $produto->id){
                        $p->ordem = $contador - 1;
                        $p->save();
                    }else{
                        $p->ordem = $contador;
                        $p->save();
                    }
                }
            }else{
                foreach ($produtos as $p) {
                    $contador = $contador + 1;
                    if ($contador == ($ordem + 1)){
                        $p->ordem = $contador - 1;
                        $p->save();
                    }else if ($p->id == $produto->id){
                        $p->ordem = $contador + 1;
                        $p->save();
                    }else{
                        $p->ordem = $contador;
                        $p->save();
                    }
                }
            }
        }

        return Redirect::back();
    }
}
