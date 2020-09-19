<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cidade extends Model
{
    use SoftDeletes;

    protected $table = 'localizacaocidade';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'estadoid',
        'nome',
        'slug'
    ];

    public function estado(){
        return $this->belongsTo('App\Model\Estado', 'estadoid');
    }

    public function enderecos(){
        return $this->hasMany('App\Model\Endereco', 'cidadeid');
    }

}
