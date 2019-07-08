<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class DepartamentoValidator.
 *
 * @package namespace App\Validators;
 */
class DepartamentoValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|unique:departamentos',
            'descricao' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|unique:departamentos',
            'descricao' => 'required'
        ],
    ];
}
