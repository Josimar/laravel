<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoFotos extends Model
{
    use SoftDeletes;

    protected $table = 'produtofotos';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'produtoid',
        'foto',
        'thumb'
    ];

    public function Produto(){
        return $this->belongsTo('App\Model\Produto', 'produtoid');
    }

}
