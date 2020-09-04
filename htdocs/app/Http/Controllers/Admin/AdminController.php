<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $rota = 'admin';

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $search = "";
        $routeName = $this->rota;
        $caminho = ['url'=>'', 'titulo'=>'Admin'];

        return view('admin.index', compact('caminho', 'search', 'routeName'));
    }
}
