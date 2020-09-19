<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imovel extends Model
{
    use SoftDeletes;

    protected $table = 'imoveis';

    protected $appends = ['links', 'thumb'];

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    protected $fillable = [
        'usuarioid',
        'titulo',
        'descricao',
        'conteudo',
        'preco',
        'quartos',
        'banheiros',
        'areaconstruida',
        'areaterreno',
        'slug'
    ];

    public function getLinksAttribute(){
        // return route('api.imoveis.show', [$this->id]);
        return [
           'href' => route('api.imoveis.show', [$this->id]),
            'rel' => 'Imóvel'
        ];
    }

    public function getThumbAttribute(){
        $thumb = $this->fotos()->where('thumb', true);

        if (!$thumb->count()) return null;

        return $thumb->first()->foto;
    }

    public function usuario(){
        return $this->belongsTo('App\User', 'usuarioid');
    }

    public function endereco(){
        return $this->belongsTo('App\Model\Endereco', 'enderecoid');
    }

    public function categorias(){
        return $this->belongsToMany('App\Model\Categoria', 'categoria_imovel', 'imovelid', 'categoriaid');
    }

    public function fotos(){
        return $this->hasMany('App\Model\ImovelFotos', 'imovelid');
    }


}
