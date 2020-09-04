<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Chamado;

class HomeController extends Controller
{
    private $rota = 'home';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $search = "";
        $routeName = $this->rota;
        $texto = trans("Texto"); // texto traduzido

        $chamados = Chamado::all();
        return view('home', compact('texto', 'chamados', 'search', 'routeName'));
    }
}

?>