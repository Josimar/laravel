<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImovelFotos extends Model
{
    use SoftDeletes;

    protected $table = 'imovelfotos';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'imovelid',
        'foto',
        'thumb'
    ];

}
