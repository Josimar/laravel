<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'listaid' => 'required',
            'categoriaid',
            'usuarioid' => 'required',
            'nome' => 'required',
            'quantidade' => 'required',
            'valor',
            'unidade',
            'precisao',
            'purchased',
        ];
    }
}
