<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transporte extends Model
{
    use SoftDeletes;

    protected $table = 'transportes';

    protected $appends = ['links'];

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'nome', 'tipo', 'descricao', 'urlfoto', 'urlvideo', 'latitude', 'longitude'
    ];

    public function getLinksAttribute(){
        return route('api.transporte.show', [$this->id]);
//        return [
//            'href' => route('api.imoveis.show', [$this->id]),
//            'rel' => 'Imóvel'
//        ];
    }

    public function fotos(){
        return $this->hasMany('App\Model\TransporteFotos', 'transporteid');
    }
}
