<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoCompra extends Model
{
    use SoftDeletes;

    protected $table = 'comprasprodutos';

    protected $appends = ['links'];

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'listaid', 'categoriaid', 'usuarioid',
        'nome', 'quantidade', 'ordem',
        'valor', 'unidade', 'precisao', 'purchased',
    ];

    public function getLinksAttribute(){
        return route('api.produtos.show', [$this->id]);
//        return [
//            'href' => route('api.imoveis.show', [$this->id]),
//            'rel' => 'Imóvel'
//        ];
    }

    public function categoria(){
        return $this->belongsTo('App\Model\CategoriaCompra', 'categoriaid');
    }

    public function categorias(){
        return $this->belongsTo('App\Model\CategoriaCompra', 'categoriaid');
    }

    public function listas(){
        return $this->belongsTo('App\Model\ListaCompra', 'listaid');
    }
}
