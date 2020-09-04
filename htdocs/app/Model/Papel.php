<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Papel extends Model
{
    protected $table = 'papeis';
    protected $fillable = ['nome', 'descricao'];

    public function users(){
        return $this->belongsToMany('App\User', 'userid', 'id');
        // return $this->belongsToMany('App\Model\Papel::class');
    }

    public function permissoes(){
        return $this->belongsToMany('App\Model\Permissao', 'papel_permissao', 'papelid', 'permissaoid');
    }

    public function adicionaPermissao($permissao)
    {
        if (is_string($permissao)) {
            $permissao = Permissao::where('nome','=',$permissao)->firstOrFail();
        }

        if($this->existePermissao($permissao)){
            return;
        }

        return $this->permissoes()->attach($permissao);

    }
    public function existePermissao($permissao)
    {
        if (is_string($permissao)) {
            $permissao = Permissao::where('nome','=',$permissao)->firstOrFail();
        }

        return (boolean) $this->permissoes()->find($permissao->id);

    }
    public function removePermissao($permissao)
    {
        if (is_string($permissao)) {
            $permissao = Permissao::where('nome','=',$permissao)->firstOrFail();
        }

        return $this->permissoes()->detach($permissao);
    }
}
