<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransporteCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'extra' => 'Dado extra'
        ];
    }

    public function with($request)
    {
        return [
            'extra_information' => 'Extra information',
            'extra' => 'Dado extra'
        ];
    }
}
