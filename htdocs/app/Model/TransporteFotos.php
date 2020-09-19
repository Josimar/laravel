<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransporteFotos extends Model
{
    use SoftDeletes;

    protected $table = 'transportefotos';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'transporteid',
        'foto',
        'thumb'
    ];

    public function Transporte(){
        return $this->belongsTo('App\Model\Transporte', 'transporteid');
    }

}
