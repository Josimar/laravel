<?php


namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\PartidaInterface;

class PartidaController
{
    private $rota = 'admin.partidas';
    private $model;
    private $colunas;

    public function __construct(PartidaInterface $model){
        $this->model = $model;
        $this->colunas = ['id'=>'#',
            'titulo'=>trans('controle.title'),
            'campeonato_rodada'=>trans('controle.round'),
            'estadio'=>trans('controle.estadio'),
            'timea'=>trans('controle.timea'),
            'timeb'=>trans('controle.timeb'),
            'placara'=>trans('controle.placara'),
            'placarb'=>trans('controle.placarb'),
            'resultado'=>trans('controle.resultado'),
            'data_format'=>trans('controle.data')];
    }

    public function index(Request $request){
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies($routeName.'-index')){
            abort(403, 'Não Autorizado');
        }
        */

        $titulo = trans('controle.match');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $orderlist = "";
        $tableNomeIdList = [];
        $registros = $this->model->all();
        $registro = '';

        return view($routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist'));
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
        $titulo = trans('controle.match');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.create').' '.$titulo],
        ];

        $search = "";
        $registros = new Collection;
        $registro = '';
        $orderlist = "";
        $tableNomeIdList = [];

        $user = auth()->user();
        $rodadas = $user->rodadas;

        return view($routeName.'.create', compact('routeName','titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist', 'rodadas'));
    }

    public function store(Request $request){
        // return response()->json(['message'=>__METHOD__]);
        // dd($request->all());

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $routeName = $this->rota;
        $data = $request->all();

        Validator::make($data, [
            'titulo' => 'required|string|max:255',
            'rodadaid' => 'required',
            'timea' => 'required',
            'timeb' => 'required',
            'data' => 'required',
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

    public function edit($id){
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies($routeName.'-index')){
            abort(403, 'Não Autorizado');
        }
        */

        $titulo = trans('controle.jackpot');
        $colunas = $this->colunas;
        $routeName = $this->rota;
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.edit').' '.$titulo],
        ];

        $search = "";
        $orderlist = "";
        $tableNomeIdList = [];
        $registros = new Collection;
        $registro = $this->model->find($id);

        $user = auth()->user();
        $rodadas = $user->rodadas;

        return view($routeName.'.edit', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist', 'rodadas'));
    }

    public function update(Request $request, $id)
    {
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: permissão
        if (Gate::denies('usuario-create')){
            abort(403, 'Não Autorizado');
        }
        */

        $routeName = $this->rota;
        $data = $request->all();

        Validator::make($data, [
            'titulo' => 'required|string|max:255',
        ])->validate();

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

    public function show($id, Request $request){
        // return response()->json(['message'=>__METHOD__]);

        /* ToDo: Permissão
        if (Gate::denies($routeName.'-index')){
            abort(403, 'Não Autorizado');
        }
        */

        $colunas = $this->colunas;
        $routeName = $this->rota;
        $titulo = trans('controle.jackpot');
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>route($routeName.'.index'), 'titulo'=>$titulo],
            ['url'=>'', 'titulo'=>trans('controle.detail').' '.$titulo],
        ];
        $search = "";
        $orderlist = "";
        $tableNomeIdList = [];
        $delete = $request->delete ?? '0';
        $registros = new Collection;
        $registro = $this->model->find($id);

        return view($routeName.'.show', compact('delete', 'routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'tableNomeIdList', 'orderlist'));
    }

    public function destroy($id)
    {
        // return response()->json(['message'=>__METHOD__]);

        $routeName = $this->rota;
        $ret = $this->model->delete($id);
        if ($ret){
            session()->flash('msgMessage', trans('controle.delete_success'));
            session()->flash('msgStatus', 'success');
            return redirect()->route($routeName.'.index');
        }else{
            session()->flash('msgMessage', trans('controle.delete_error'));
            session()->flash('msgStatus', 'error');
            return redirect()->back();
        }

    }
}
