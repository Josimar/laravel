<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;

    protected $table = 'produtos';

    protected $appends = ['links'];

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'listaid', 'categoriaid', 'usuarioid',
        'nome', 'quantidade',
        'valor', 'unidade', 'precisao', 'purchased',
    ];

    public function getLinksAttribute(){
        return route('api.produto.show', [$this->id]);
//        return [
//            'href' => route('api.imoveis.show', [$this->id]),
//            'rel' => 'Imóvel'
//        ];
    }

    public function fotos(){
        return $this->hasMany('App\Model\ProdutoFotos', 'produtoid');
    }

    public function categorias(){
        return $this->belongsToMany('App\Model\Categoria', 'sistema_categoria', 'sistemaid', 'categoriaid');
    }
}
