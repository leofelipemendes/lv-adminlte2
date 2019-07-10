<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'rg' => 'required',
            'cpf' => 'required|unique:clientes',
            'endereco' => 'required',
            'bairro' => 'required',
            'numero' => 'required',
            'complemento' => 'required',
            'idcidade' => 'required',
            'iduf' => 'required',
            'contato' => 'required',
            'email' => 'required|unique:clientes'
        ];
    }
}
