<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Model\Papel;

// class User extends Authenticatable implements JWTSubject
class User extends Authenticatable
{
    use Notifiable;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT = 'deleted';

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ehAdmin(){
        return $this->existePapel('Admin');
    }

    public function profile(){
        return $this->hasOne('App\Model\Profile', 'usuarioid');
    }

    public function papeis(){
        return $this->belongsToMany('App\Model\Papel', 'papel_user', 'userid', 'papelid');
    }

    public function listas(){
        return $this->hasMany('App\Model\Lista','usuarioid');
    }

    public function imoveis(){
        return $this->hasMany('App\Model\Imovel','usuarioid');
    }

    public function chamados(){
        return $this->belongsToMany('App\Model\Chamado');
    }

    public function boloes(){
        return $this->hasMany('App\Model\Bolao', 'usuarioid');
    }

    public function meusBoloes(){
        return $this->belongsToMany('App\Model\Bolao', 'usuario_bolao', 'usuarioid', 'bolaoid')->withPivot('pontos');
    }

    public function partidas(){
        return $this->belongsToMany('App\Model\Partida', 'usuario_bolaopartida', 'usuarioid', 'partidaid')->withPivot('resultado', 'placara', 'placarb');
    }

    public function getRodadasAttribute(){
        $boloes = $this->boloes;
        $rounds = [];
        foreach ($boloes as $key => $value){
            $rounds[] = $value->rodadas;
        }

        return Arr::collapse($rounds);
    }

    public function adicionarPapel($papel){
        if (is_string($papel)){
            $papel = Papel::where('nome','=',$papel)->firstOrFail();
        }
        if ($this->existePapel($papel)){
            return;
        }
        return $this->papeis()->attach($papel);
    }

    public function existePapel($papel){
        if (is_string($papel)){
            $papel = Papel::where('nome', '=', $papel)->firstOrFail();
        }
        return (boolean) $this->papeis()->find($papel->id);
    }

    public function removePapel($papel){
        if (is_string($papel)){
            $papel = papel::where('nome', '=', $papel)->firstOrFail();
        }
        return $this->papeis()->detach($papel);
    }

    public function temPermissao($papeis){
        $userPapeis = $this->papeis;
        return $papeis->intersect($userPapeis)->count();
    }

    /*
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    */
}
