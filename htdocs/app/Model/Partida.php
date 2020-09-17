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

    public function usuarios(){
        return $this->belongsToMany('App\User', 'usuario_bolaopartida', 'partidaid', 'usuarioid')->withPivot('resultado', 'placara', 'placarb');
    }

    public function getApostaTimeAAttribute(){
        $user = auth()->user();
        return $this->usuarios()->find($user->id)->pivot->placara ?? null;
    }

    public function getApostaTimeBAttribute(){
        $user = auth()->user();
        return $this->usuarios()->find($user->id)->pivot->placarb ?? null;
    }

    public function setDataAttribute($value){
        $date = date_create($value);
        $this->attributes['data'] = date_format($date, 'Y-m-d H:i:s');
    }

    public function getRodadaTituloAttribute(){
        return $this->rodada->titulo;
    }

    public function getCampeonatoRodadaAttribute(){
        return $this->rodada->bolao_title." - ".$this->rodada->titulo;
    }

    public function getDataFormatAttribute(){
        $date = date_create($this->data);
        return date_format($date, 'd/m/Y H:i:s');
    }

}
