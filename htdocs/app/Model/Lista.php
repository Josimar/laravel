<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lista extends Model
{
    use SoftDeletes;

    protected $table = 'listas';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'usuarioid',
        'nome'
    ];

    public function usuario(){
        return $this->belongsTo('App\User', 'usuarioid');
    }

    public function usuarios(){
        return $this->belongsToMany('App\User', 'usuario_lista', 'listaid', 'usuarioid');
    }

    public function produtos(){
        // return $this->belongsTo('App\Model\Produto','nadaaverid');
        return $this->hasMany('App\Model\Produto','nadaaverid');
    }
}
