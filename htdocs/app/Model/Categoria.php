<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $table = 'categorias';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $fillable = [
        'usuarioid',
        'descricao'
    ];

    public function sistemas(){
        return $this->belongsToMany('App\Model\Sistema', 'sistema_categoria', 'categoriaid', 'sistemaid');
    }

    public function imoveis(){
        return $this->belongsToMany('App\Model\Imovel', 'categoria_imovel', 'categoriaid', 'imovelid');
    }
}
