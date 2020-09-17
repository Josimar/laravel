<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BolaoUsuario extends Model
{
    protected $table = 'usuario_bolao';

    protected $fillable = [
        'usuarioid',
        'bolaoid',
        'pontos'
    ];

}
