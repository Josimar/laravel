<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Model\Chamado;
use Auth;

class ChamadoController extends Controller
{
    private $rota = 'chamado';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $search = "";
        $routeName = $this->rota;

        $user = Auth::user();
        // dd($user);
        // $chamados = Chamado::where('userid', '=', $user->id)->get();
        $chamados = Chamado::all();
        return view('chamados', compact('chamados', 'search', 'routeName'));
    }

    public function detalhe($id){
        $chamado = Chamado::find($id);
        $this->authorize('ver-chamado', $chamado);

        /*
        if (Gate::denies('ver-chamado', $chamado)){
            abort(403, 'Não autorizado');
        }

        if (Gate::allows('ver-chamado', $chamado)){
            return view('detalhe', compact('chamado'));
        }
        */

        return view('detalhe', compact('chamado'));
    }

}

?>