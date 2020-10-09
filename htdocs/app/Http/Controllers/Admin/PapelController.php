<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Repositories\Contracts\PapelInterface;
use App\Repositories\Contracts\PermissaoInterface;

class PapelController extends Controller
{
    private $rota = 'papeis';
    private $model;
    private $modelPermissao;
    private $colunas;

    private $paginate = 10;
    private $filtro = ['nome', 'descricao'];

    public function __construct(PapelInterface $model, PermissaoInterface $modelPermissao){
        $this->model = $model;
        $this->modelPermissao = $modelPermissao;
        $this->colunas = ['id'=>'#', 'nome'=>trans('controle.name'), 'descricao'=>trans('controle.description')];
    }

    public function index()
    {
        /*
        if (Gate::denies('papel-view')){
            abort(403, 'Não Autorizado');
        }
        */

        $titulo = trans('controle.paper');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('admin.index'), 'titulo'=>'Dashboard'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $registro = '';
        $orderlist = "";
        $tableNomeIdList = [];
        if (isset($request->search)){
            $search = $request->search;
            $registros = $this->model->findWhereLike($this->filtro, $search, 'id', 'DESC');
        }else{
            $registros = $this->model->all();
        }

        return view('admin.'.$routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist'));
    }

    public function permissao($id)
    {
        if (Gate::denies('papel-edit')){
            abort(403, 'Não Autorizado');
        }

      $papel = Papel::find($id);
      $permissao = Permissao::all();
      $caminhos = [
          ['url'=>'/admin','titulo'=>'Admin'],
          ['url'=>route('papeis.index'),'titulo'=>'Papéis'],
          ['url'=>'','titulo'=>'Permissões'],
      ];
      return view('admin.papel.permissao',compact('papel','permissao','caminhos'));
    }

    public function permissaoStore(Request $request,$id)
    {
        if (Gate::denies('papel-edit')){
            abort(403, 'Não Autorizado');
        }

        $papel = Papel::find($id);
        $dados = $request->all();
        $permissao = Permissao::find($dados['permissao_id']);
        $papel->adicionaPermissao($permissao);
        return redirect()->back();
    }

    public function permissaoDestroy($id,$permissao_id)
    {
        if (Gate::denies('papel-edit')){
            abort(403, 'Não Autorizado');
        }

      $papel = Papel::find($id);
      $permissao = Permissao::find($permissao_id);
      $papel->removePermissao($permissao);
      return redirect()->back();
    }

    public function create()
    {
        /*
        if (Gate::denies('papel-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.paper');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('admin.index'), 'titulo'=>'Dashboard'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.create').' '.$titulo],
        ];

        $permissoes = $this->modelPermissao->all('nome', 'ASC');

        $search = "";
        $registros = new Collection;
        $registro = '';
        $orderlist = "";
        $tableNomeIdList = [];

        return view('admin.'.$routeName.'.create', compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist', 'permissoes'));
    }

    public function store(Request $request)
    {
        /*
        if (Gate::denies('papel-edit')){
            abort(403, 'Não Autorizado');
        }
        */

        $routeName = $this->rota;
        $data = $request->all();

        Validator::make($data, [
            'nome' => 'required|string|max:255'
        ])->validate();

        if($request['nome'] && $request['nome'] != "Admin"){
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

        session()->flash('msgMessage', trans('controle.add_error'));
        session()->flash('msgStatus', 'error');
        return redirect()->back();
    }

    public function show($id)
    {
        // return response()->json(['message'=>__METHOD__]);

        /*
        if (Gate::denies('papel-view')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.paper');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('admin.index'), 'titulo'=>'Dashboard'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.detail').' '.$titulo],
        ];
        $search = "";
        $orderlist = "";
        $tableNomeIdList = [];
        $delete = $request->delete ?? '0';
        $registros = new Collection;
        $registro = $this->model->find($id);

        return view('admin.'.$routeName.'.show', compact('delete', 'routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist'));
    }

    public function edit($id)
    {
        /*
        if (Gate::denies('papel-edit')){
            abort(403, 'Não Autorizado');
        }
        */

        $titulo = trans('controle.users');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('admin.index'), 'titulo'=>'Dashboard'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.edit').' '.$titulo],
        ];

        $search = "";
        $orderlist = "";
        $tableNomeIdList = [];
        $registros = new Collection;
        $registro = $this->model->find($id);

        $permissoes = $this->modelPermissao->all('nome', 'ASC');

        return view('admin.'.$routeName.'.edit', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist', 'permissoes'));
    }

    public function update(Request $request, $id)
    {
        /*
        if (Gate::denies('papel-edit')){
            abort(403, 'Não Autorizado');
        }
        */
        if($this->model->find($id)->nome == "Admin"){
            return redirect()->route('papeis.index');
        }
        if($request['nome'] && $request['nome'] != "Admin"){
            $routeName = $this->rota;
            $data = $request->all();

            Validator::make($data, [
                'nome' => 'required|string|max:255'
            ]);

            if ($this->model->update($data, $id)){
                session()->flash('msgMessage', trans('controle.edit_success'));
                session()->flash('msgStatus', 'success');
                return redirect(route($routeName.'.index'));
            }
        }

        session()->flash('msgMessage', trans('controle.edit_error'));
        session()->flash('msgStatus', 'error');
        return redirect(route($routeName.'.edit'));
    }

    public function destroy($id)
    {
        if (Gate::denies('papel-delete')){
            abort(403, 'Não Autorizado');
        }
        if(Papel::find($id)->nome == "Admin"){
            return redirect()->route('papeis.index');
        }
        Papel::find($id)->delete();
        return redirect()->route('papeis.index');
    }
}
