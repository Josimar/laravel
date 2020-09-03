<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Model\Papel;

class UsuarioController extends Controller
{
    private $rota = 'usuarios';
    private $page;
    private $paginate = 2;
    private $filtro = ['name', 'email'];
    private $model;

    public function __construct(UserRepositoryInterface $model){
        $this->page = trans('controle.nomePage');
        $this->model = $model;
    }

    public function index(Request $request)
    {
        // return response()->json(['message'=>__METHOD__]);

        if (Gate::denies('usuario-view')){
            abort(403, 'Não Autorizado');
        }

        $page = $this->page;
        $routeName = $this->rota;
        $search = "";

        if (isset($request->search)){
            $search = $request->search;
            $usuarios = $this->model->findWhereLike($this->$filtro, $search, 'id', 'DESC');
        }else{
            $usuarios = $this->model->paginate($this->paginate);
        }

        $caminhos = [
            ['url'=>'../admin', 'titulo'=>'Admin'],
            ['url'=>'', 'titulo'=>'Usuários'],
        ];
        return view('admin.usuarios.index', compact('usuarios', 'caminhos', 'search', 'routeName'));
    }

    public function papel($id){
        if (Gate::denies('usuario-edit')){
            abort(403, 'Não Autorizado');
        }
        
        $usuario = User::find($id);
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

        $usuario = User::find($id);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('usuario-edit')){
            abort(403, 'Não Autorizado');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('usuario-edit')){
            abort(403, 'Não Autorizado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('usuario-delete')){
            abort(403, 'Não Autorizado');
        }
    }
}
