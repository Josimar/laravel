<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = ['userid', 'titulo', 'descricao', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
