<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bolao extends Model
{
    use SoftDeletes;

    protected $table = 'boloes';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'usuarioid',
        'titulo',
        'descricao',
        'rodadaatual',
        'pontosresultado',
        'pontosextra',
        'pontostaxa',
    ];

    public function usuario(){
        return $this->belongsTo('App\User', 'usuarioid');
    }

    public function Apostadores(){
        return $this->belongsToMany('App\User', 'usuario_bolao', 'bolaoid', 'usuarioid')->withPivot('pontos');
    }

    public function getTituloAttribute($value){
        return ucwords(mb_strtolower($value));
    }

    public function getNomeUsuarioAttribute($value){
        return $this->usuario->name;
    }

    public function rodadas(){
        return $this->hasMany('App\Model\Rodada', 'bolaoid');
    }
}
