<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transporte extends Model
{
    use SoftDeletes;

    protected $table = 'transportes';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'nome', 'tipo', 'descricao', 'urlfoto', 'urlvideo', 'latitude', 'longitude'
    ];
}
