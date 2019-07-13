<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorCreateRequest extends FormRequest
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
        $this->sanitize();
        return [
            'nomefantasia' => 'required',
            'razaosocial' => 'required',
            'cnpj' => 'required|unique:fornecedores',
            'iduf' => 'required',
            'iduf' => 'required',
            'idmunicipio' => 'required',
            'idmunicipio' => 'required',
            'ie' => 'required|unique:fornecedores',
            'im' => 'required|unique:fornecedores',
//            'matriz' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
            'numero' => 'required',
            'complemento' => 'required',
            'contato' => 'required',
            'tel_contato' => 'required',        
        ];
    }
    
    public function sanitize() {
        
        $dados = $this->all();
        
        $dados['cnpj'] = preg_replace( '/\D+/', '', $dados['cnpj'] );
        
        $dados['ie'] = preg_replace( '/\D+/', '', $dados['ie'] );
        
        $dados['tel_contato'] = preg_replace( '/\D+/', '', $dados['tel_contato'] );
        
        return $this->replace($dados);
    }

}
