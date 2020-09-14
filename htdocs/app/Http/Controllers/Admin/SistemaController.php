<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Repositories\Contracts\SistemaInterface;

class SistemaController extends Controller
{
    private $rota = 'sistemas';
    private $model;
    private $colunas;

    private $paginate = 10;
    private $filtro = ['titulo', 'descricao'];

    public function __construct(SistemaInterface $model){
        $this->model = $model;
        $this->colunas = ['id'=>'#',
            'titulo'=>trans('controle.title'), 'descricao'=>trans('controle.description'), 'publico'=>trans('controle.public')];
    }

    public function index()
    {
        /* ToDo: Permissão
        if (Gate::denies('sistema-view')){
            abort(403, 'Não Autorizado');
        }
        */
        $routeName = $this->rota;

        $titulo = trans('controle.systems');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('admin.index'), 'titulo'=>'Dashboard'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $registro = '';
        if (isset($request->search)){
            $search = $request->search;
            $registros = $this->model->findWhereLike($this->filtro, $search, 'id', 'DESC');
        }else{
            $registros = $this->model->all();
        }

        return view('admin.'.$routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro'));
    }

    public function permissao($id)
    {
        /* ToDo: Permissão
        if (Gate::denies('sistema-edit')){
            abort(403, 'Não Autorizado');
        }
        */

      $sistema = Sistema::find($id);
      $caminhos = [
          ['url'=>'/admin','titulo'=>'Admin'],
          ['url'=>route('sistemas.index'),'titulo'=>'Sistemas'],
          ['url'=>'','titulo'=>'Categorias'],
      ];
      return view('admin.sistema.categoria',compact('sistema','categoria','caminhos'));
    }

    public function categoriaStore(Request $request,$id)
    {
        /* ToDo: Permissão
        if (Gate::denies('sistema-edit')){
            abort(403, 'Não Autorizado');
        }
        */

        $papel = Sistema::find($id);
        $dados = $request->all();
        $permissao = Categoria::find($dados['sistema_id']);
        $papel->adicionaCategoria($categoria);
        return redirect()->back();
    }

    public function categoriaDestroy($id,$categoria_id)
    {
        /* ToDo: Permissão
        if (Gate::denies('sistema-edit')){
            abort(403, 'Não Autorizado');
        }
        */

      $sistema = Sistema::find($id);
      $categoria = Categoria::find($categoria_id);
      $sistema->removePermissao($categoria);
      return redirect()->back();
    }

    public function create()
    {
        /* ToDo: Permissão
        if (Gate::denies('sistema-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.systems');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('admin.index'), 'titulo'=>'Dashboard'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.create').' '.$titulo],
        ];

        $search = "";
        $registros = new Collection;
        $registro = '';

        return view('admin.'.$routeName.'.create', compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro'));
    }

    public function store(Request $request)
    {
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        /* ToDo: Permissão
        if (Gate::denies('sistemas-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $routeName = $this->rota;
        $data = $request->all();

        Validator::make($data, [
            'titulo' => 'required|string|max:255'
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

    public function show($id)
    {
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies('sistema-view')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.systems');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('admin.index'), 'titulo'=>'Dashboard'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.detail').' '.$titulo],
        ];
        $search = "";
        $delete = $request->delete ?? '0';
        $registros = new Collection;
        $registro = $this->model->find($id);

        return view('admin.'.$routeName.'.show', compact('delete', 'routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro'));
    }

    public function edit($id)
    {
         // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        /* ToDo: Permissão
        if (Gate::denies('sistema-edit')){
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
        $registros = new Collection;
        $registro = $this->model->find($id);

        return view('admin.'.$routeName.'.edit', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro'));
    }

    public function update(Request $request, $id)
    {
        /* ToDo: Permissão
        if (Gate::denies('sistema-edit')){
            abort(403, 'Não Autorizado');
        }
        */

        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        $routeName = $this->rota;
        $data = $request->all();

        Validator::make($data, [
            'titulo' => 'required|string|max:255'
        ]);

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

    public function destroy($id)
    {
        /* ToDo: Permissão
        if (Gate::denies('sistema-delete')){
            abort(403, 'Não Autorizado');
        }
        */

        if(Sistema::find($id)->nome == "Admin"){
            return redirect()->route('sistemas.index');
        }
        Sistema::find($id)->delete();
        return redirect()->route('sistemas.index');
    }
}
