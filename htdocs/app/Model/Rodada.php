<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rodada extends Model
{
    use SoftDeletes;

    protected $table = 'boloesrodada';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'bolaoid',
        'titulo',
        'datainicial',
        'datafinal',
    ];

    public function bolao(){
        return $this->belongsTo('App\Model\Bolao', 'bolaoid');
    }

    public function getBolaoTitleAttribute(){
        return $this->bolao->titulo;
    }

    public function setDatainicialAttribute($value){
        $date = date_create($value);
        $this->attributes['datainicial'] = date_format($date, 'Y-m-d H:i:s');
    }

    public function setDatafinalAttribute($value){
        $date = date_create($value);
        $this->attributes['datafinal'] = date_format($date, 'Y-m-d H:i:s');
    }

    public function getDatainicialFormatAttribute(){
        $date = date_create($this->datainicial);
        return date_format($date, 'd/m/Y H:i:s');
    }

    public function getDatafinalFormatAttribute(){
        $date = date_create($this->datafinal);
        return date_format($date, 'd/m/Y H:i:s');
    }

}
