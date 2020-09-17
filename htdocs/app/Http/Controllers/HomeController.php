<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BolaoInterface;
use App\Repositories\Contracts\PartidaInterface;
use App\Repositories\Eloquent\BolaoRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $rota = 'home';

    public function __construct()
    {
    }

    public function index()
    {
    }

    public function signNoLogin($id)
    {
        return response()->json(['message'=>__METHOD__]);
        return redirect()->route('boloes.index');
    }

    public function sign($id, BolaoInterface $model){
        // return response()->json(['message'=>__METHOD__]);

        $model->BolaoUsuario($id);
        return redirect(route('boloes.index').'#portfolio');
    }

    public function rodadas($id, BolaoInterface $model){
        // return response()->json(['message'=>__METHOD__]);
        $titulo = trans('controle.rounds');
        $colunas = ['id'=>'#', 'titulo'=>trans('controle.title'),
            'bolao_title'=>trans('controle.bolao'),
            'datainicial_format'=>trans('controle.datainicial'),
            'datafinal_format'=>trans('controle.datafinal')];
        $routeName = 'boloes.rodadas';
        $routeNameDetail = 'partidas';
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $registros = $model->rodadas($id);
        $registro = '';
        $bolao = $model->find($id);
        $titulo = $titulo.' ('.$bolao->titulo.')';

        if (!$registros){
            return redirect(route('bolao.index').'#portfolio');
        }

        return view($routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'routeNameDetail'));
    }

    public function partidas($id, BolaoInterface $model){
        // return response()->json(['message'=>__METHOD__]);

        $titulo = trans('controle.rounds');
        $colunas = ['id'=>'#',
            'titulo'=>trans('controle.title'),
            'campeonato_rodada'=>trans('controle.round'),
            'estadio'=>trans('controle.estadio'),
            'data_format'=>trans('controle.data')];
        $routeName = 'boloes.rodadas';
        $routeNameDetail = 'resultado';
        $caminhos = [
            ['url'=>route('home'), 'titulo'=>'Home'],
            ['url'=>'', 'titulo'=>$titulo]
        ];

        $search = "";
        $registros = $model->partidas($id);
        $registro = '';
        $bolao = $model->bolaoByRodada($id);
        $titulo = $titulo.' ('.$bolao->titulo.')';

        if (!$registros){
            return redirect(route('bolao.index').'#portfolio');
        }

        return view($routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'routeNameDetail'));
    }

    public function resultado($id, PartidaInterface $model, BolaoRepository $modelBolao){
        // return response()->json(['message'=>__METHOD__]);

        $partida = $model->partida($id);
        If(!$partida){
            return redirect()->route('bolao.index');
        }
        $routeName = 'boloes.resultado';
        $routeNameDetail = '';
        $bolao = $modelBolao->bolaoByRodada($partida->rodada->id);
        $registro = $partida;
        $registros = new Collection;
        $titulo = '';
        $search = '';
        $caminhos = [];
        $colunas = [];

        return view($routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'routeNameDetail'));
    }

    public function update($partidaid, Request $request, PartidaInterface $model){
        // return response()->json(['message'=>__METHOD__]);

        $data = $request->all();
        // ToDo: validação ...
        if($partida = $model->PartidaUsuarioSave($partidaid, $data)){
            session()->flash('msg', trans('bolao.successfully_edited_record'));
            session()->flash('status', 'success');
            return redirect()->route('partidas', $partidaid);
        } else {
            session()->flash('msg', trans('bolao.error_editing_record'));
            session()->flash('status', 'error');
            return redirect()->back();
        }
    }

    public function classificacao($bolaoid, BolaoInterface $model)
    {
        $columnList = ['OrderAsc'=>'#',
            'name'=>trans('bolao.name'),
            'pivot_points'=>trans('bolao.pontos')
        ];

        $bolao = $model->find($bolaoid);
        $routeName = 'boloes.resultado';
        $routeNameDetail = '';
        $registro = $model->classification($bolaoid);
        $registros = new Collection;
        $titulo = '';
        $search = '';
        $caminhos = [];
        $colunas = [];

        return view($routeName.'.index', compact('routeName', 'titulo', 'search', 'caminhos', 'colunas', 'registros', 'registro', 'routeNameDetail'));
    }

}

?>
