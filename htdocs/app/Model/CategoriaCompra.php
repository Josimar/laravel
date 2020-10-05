<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaCompra extends Model
{
    use SoftDeletes;

    protected $table = 'comprascategorias';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $fillable = [
        'descricao',
        'categoriaid',
        'slug',
        'nivel'
    ];

    public function childs() {
        return $this->hasMany('App\Model\CategoriaCompra','categoriaid','id') ;
    }

    public function usuarios(){
        return $this->belongsToMany('App\User','usuario_comprascategorias', 'categoriaid', 'usuarioid');
    }

}
