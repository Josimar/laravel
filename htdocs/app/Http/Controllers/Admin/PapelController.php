<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Model\Papel;
use App\Model\Permissao;

class PapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('papel-view')){
            abort(403, 'Não Autorizado');
        }

        $registros = Papel::all();
        $caminhos = [
        ['url'=>'/admin','titulo'=>'Admin'],
        ['url'=>'','titulo'=>'Papéis']
        ];
        return view('admin.papel.index',compact('registros','caminhos'));
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
        if (Gate::denies('papel-create')){
            abort(403, 'Não Autorizado');
        }

        $caminhos = [
            ['url'=>'/admin','titulo'=>'Admin'],
            ['url'=>route('papeis.index'),'titulo'=>'Papéis'],
            ['url'=>'','titulo'=>'Adicionar']
            ];
      
            return view('admin.papel.adicionar',compact('caminhos'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('papel-edit')){
            abort(403, 'Não Autorizado');
        }

        if($request['nome'] && $request['nome'] != "Admin"){
            Papel::create($request->all());
  
            return redirect()->route('papeis.index');
        }
  
        return redirect()->back();
    }

    public function show($id)
    {
        if (Gate::denies('papel-view')){
            abort(403, 'Não Autorizado');
        }
    }

    public function edit($id)
    {
        if (Gate::denies('papel-edit')){
            abort(403, 'Não Autorizado');
        }

        if(Papel::find($id)->nome == "Admin"){
            return redirect()->route('papeis.index');
        }
  
        $registro = Papel::find($id);
  
        $caminhos = [
        ['url'=>'/admin','titulo'=>'Admin'],
        ['url'=>route('papeis.index'),'titulo'=>'Papéis'],
        ['url'=>'','titulo'=>'Editar']
        ];
  
        return view('admin.papel.editar',compact('registro','caminhos'));
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('papel-edit')){
            abort(403, 'Não Autorizado');
        }
        if(Papel::find($id)->nome == "Admin"){
            return redirect()->route('papeis.index');
        }
        if($request['nome'] && $request['nome'] != "Admin"){
          Papel::find($id)->update($request->all());
        }
  
        return redirect()->route('papeis.index');
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
