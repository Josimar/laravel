<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Sistema extends Model
{
    protected $table = 'sistemas';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $fillable = ['titulo', 'descricao'];

    public function users(){
        return $this->belongsToMany('App\User', 'userid', 'id');
    }

    public function categorias(){
        return $this->belongsToMany('App\Model\Categoria', 'sistema_categoria', 'sistemaid', 'categoriaid');
    }

    public function adicionaCategoria($categoria)
    {
        if (is_string($categoria)) {
            $categoria = Categoria::where('nome','=',$categoria)->firstOrFail();
        }

        if($this->existeCategoria($categoria)){
            return;
        }

        return $this->categorias()->attach($categoria);

    }
    public function existeCategoria($categoria)
    {
        if (is_string($categoria)) {
            $categoria = Categoria::where('nome','=',$categoria)->firstOrFail();
        }

        return (boolean) $this->categorias()->find($categoria->id);

    }
    public function removeCategoria($categoria)
    {
        if (is_string($categoria)) {
            $categoria = Categoria::where('nome','=',$categoria)->firstOrFail();
        }

        return $this->categorias()->detach($categoria);
    }
}
