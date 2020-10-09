<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Repositories\Contracts\UsuarioInterface;
use App\Repositories\Contracts\PapelInterface;
use App\Model\Papel;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    private $rota = 'usuarios';
    private $model;
    private $modelPapel;
    private $colunas;

    private $paginate = 10;
    private $filtro = ['name', 'email'];

    public function __construct(UsuarioInterface $model, PapelInterface $modelPapel){
        $this->model = $model;
        $this->modelPapel = $modelPapel;
        $this->colunas = ['id'=>'#', 'name'=>trans('controle.name'), 'email'=>trans('controle.email')];
    }

    public function index(Request $request)
    {
        // return response()->json(['message'=>__METHOD__]);
        if (Gate::denies('usuario-view')){
            abort(403, 'Não Autorizado');
        }

        $titulo = trans('controle.users');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('admin.index'), 'titulo'=>'Dashboard'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $usuario = '';
        if (isset($request->search)){
            $search = $request->search;
            $usuarios = $this->model->findWhereLike($this->filtro, $search, 'id', 'DESC');
        }else{
            $usuarios = $this->model->all();
        }
        $orderlist = "";
        $tableNomeIdList = [];

        return view('admin.'.$routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'usuarios', 'usuario', 'tableNomeIdList', 'orderlist'));
    }

    public function create()
    {
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.users');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route('admin.index'), 'titulo'=>'Dashboard'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.create').' '.$titulo],
        ];

        $search = "";
        $registros = new Collection;
        $registro = '';
        $papeis = $this->modelPapel->all('nome', 'ASC');
        $tableNomeIdList = [];
        $orderlist = "";

        return view('admin.'.$routeName.'.create', compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist', 'papeis'));
    }

    public function show($id, Request $request)
    {
        // return response()->json(['message'=>__METHOD__]);

        /*
        if (Gate::denies('usuario-show')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.users');
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
        $tableNomeIdList = [];
        $orderlist = "";

        return view('admin.'.$routeName.'.show', compact('delete', 'routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist'));
    }

    public function edit($id)
    {
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        if (Gate::denies('usuario-edit')){
            abort(403, 'Não Autorizado');
        }

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
        $papeis = $this->modelPapel->all('nome', 'ASC');
        $tableNomeIdList = [];
        $orderlist = "";

        return view('admin.'.$routeName.'.edit', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist', 'papeis'));
    }

    public function update(Request $request, $id)
    {
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        if (Gate::denies('usuario-edit')){
            abort(403, 'Não Autorizado');
        }

        $routeName = $this->rota;
        $data = $request->all();
        if (!$data['password']){
            unset($data['password']);
        }

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore('id')],
            'password' => 'sometimes|required|string|email|min:3|confirmed'
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
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        if (Gate::denies('usuario-delete')){
            abort(403, 'Não Autorizado');
        }

        session()->flash('msgMessage', trans('controle.delete_error'));
        session()->flash('msgStatus', 'success');
        return redirect()->back();
    }


    public function papel($id){
        if (Gate::denies('usuario-edit')){
            abort(403, 'Não Autorizado');
        }

        $usuario = $this->model->find($id);
        $papel = Papel::all();
        $caminhos = [
            ['url'=>'/admin', 'titulo'=>'Admin'],
            ['url'=>route('usuarios.index'), 'titulo'=>'Usuários'],
            ['url'=>'', 'titulo'=>'Papel'],
        ];
        return view('admin.usuarios.papel', compact('usuario', 'papel', 'caminhos'));
    }

    public function papelStore(Request $request, $id){
        if (Gate::denies('usuario-edit')){
            abort(403, 'Não Autorizado');
        }

        $usuario = $this->model->find($id);
        $dados = $request->all();
        $papel = Papel::find($dados['papelid']);
        $usuario->adicionarPapel($papel);
        return redirect()->back();
    }

    public function papelDestroy($id, $papelid){
        if (Gate::denies('usuario-edit')){
            abort(403, 'Não Autorizado');
        }

        $usuario = User::find($id);
        $papel = Papel::find($papelid);
        $usuario->removePapel($papel);
        return redirect()->back();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }

        $data = $request->all();

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed'
        ])->validate();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->adicionarPapel('Usuario');

        if ($user){
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
}
