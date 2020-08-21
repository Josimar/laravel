<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransporteResource extends JsonResource
{
    public function toArray($request)
    {
        /*
        return [
            'nome'=>$this->nome,
            'tipo'=>$this->tipo,
            'descricao'=>$this->descricao
        ];
        */

        return $this->resource->toArray();
    }
}

