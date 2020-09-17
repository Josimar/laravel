<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'usuarioid' => 'required',
            'nome' => 'required'
        ];
    }
}
