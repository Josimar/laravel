<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BolaoUsuarioPartida extends Model
{
    protected $table = 'usuario_bolaopartida';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'usuarioid',
        'partidaid',
        'resultado',
        'placara',
        'placarb'
    ];

}
