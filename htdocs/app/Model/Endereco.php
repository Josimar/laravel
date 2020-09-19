<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
    use SoftDeletes;

    protected $table = 'localizacaoendereco';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'cidadeid',
        'estadoid',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'zipcode'
    ];

    public function estado(){
        return $this->belongsTo('App\Model\Estado', 'estadoid');
    }

    public function cidade(){
        return $this->belongsTo('App\Model\Cidade', 'cidadeid');
    }

    public function imovel(){
        return $this->hasOne('App\Model\Imovel', 'imovelid');
    }

}
