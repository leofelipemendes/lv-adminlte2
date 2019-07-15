<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ClienteValidator.
 *
 * @package namespace App\Validators;
 */
class ClienteValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required',
            'rg' => 'required|unique:clientes',
            'cpf' => 'required|unique:clientes',
            'endereco' => 'required',
            'bairro' => 'required',
            'numero' => 'required',
            'complemento' => 'required',
            'iduf' => 'required',
            'idmunicipio' => 'required',
            
            'contato' => 'required',
            'email' => 'required|email'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required',
            'rg' => 'required',
            'cpf' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
            'numero' => 'required',
            'complemento' => 'required',
            'iduf' => 'required',
            'idmunicipio' => 'required',
            
            'contato' => 'required',
            'email' => 'required|email'
        ],
    ];
}
