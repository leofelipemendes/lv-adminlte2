<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteCreateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        
        $this->sanitize();
        
        return [
            
        ];
    }
    
    public function sanitize() {
        
        $dados = $this->all();
        
        $dados['cpf'] = preg_replace( '/\D+/', '', $dados['cpf'] );
        
        $dados['rg'] = preg_replace( '/\D+/', '', $dados['rg'] );
        
        return $this->replace($dados);
    }

}
