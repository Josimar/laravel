<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imovel extends Model
{
    use SoftDeletes;

    protected $table = 'imoveis';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'usuarioid',
        'titulo',
        'descricao',
        'conteudo',
        'preco',
        'quartos',
        'banheiros',
        'areaconstruida',
        'areaterreno',
        'slug'
    ];

    public function usuario(){
        return $this->belongsTo('App\User', 'usuarioid');
    }

    public function categorias(){
        return $this->belongsToMany('App\Model\Categoria', 'categoria_imovel', 'imovelid', 'categoriaid');
    }
}
