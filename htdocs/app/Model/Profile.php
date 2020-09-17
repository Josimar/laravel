<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    protected $table = 'userprofiles';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = ['usuarioid', 'sobre', 'redes', 'fone'];

    public function users(){
        return $this->belongsToMany('App\User', 'usuarioid', 'id');
    }

}
