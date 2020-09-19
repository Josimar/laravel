<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use SoftDeletes;

    protected $table = 'localizacaoestado';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'paisid',
        'nome',
        'slug',
        'initials'
    ];

    public function pais(){
        return $this->belongsTo('App\Model\Pais', 'paisid');
    }

    public function cidades(){
        return $this->hasMany('App\Model\Cidade', 'cidadeid');
    }

    public function enderecos(){
        return $this->hasMany('App\Model\Endereco', 'estadoid');
    }

}
