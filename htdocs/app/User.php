<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Tymon\JWTAuth\Contracts\JWTSubject;
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ehAdmin(){
        return $this->existePapel('Admin');
    }

    public function chamados(){
        return $this->belongsToMany('App\Model\Chamado');
    }

    public function papeis(){
        return $this->belongsToMany('App\Model\Papel', 'papel_user', 'userid', 'papelid');
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
