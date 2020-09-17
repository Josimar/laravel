<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImovelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'usuarioid' => 'required',
            'titulo' => 'required',
            'descricao',
            'conteudo',
            'preco',
            'quartos',
            'banheiros',
            'areaconstruida',
            'areaterreno',
            'slug'
        ];
    }
}
