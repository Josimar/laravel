<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partida extends Model
{
    use SoftDeletes;

    protected $table = 'boloespartida';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'rodadaid',
        'titulo',
        'estadio',
        'timea',
        'timeb',
        'resultado',
        'placara',
        'placarb',
        'data',
    ];

    public function rodada(){
        return $this->belongsTo('App\Model\Rodada', 'rodadaid');
    }

    public function setDataAttibute($value){
        $date = date_create($value);
        $this->attributes['data'] = date_format($date, 'Y-m-d H:i:s');
    }

    public function getDateSiteAttribute(){
        $date = date_create($this->data);
        return date_format($date, 'd/m/Y H:i:s');
    }

}
