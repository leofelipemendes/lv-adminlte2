<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fornecedor.
 *
 * @package namespace App\Entities;
 */
class Fornecedor extends Model implements Transformable
{
    use TransformableTrait,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomefantasia',
        'razaosocial',
        'cnpj',
        'iduf',
        'iduf',
        'idmunicipio',
        'idmunicipio',
        'ie',
        'im',
        'matriz',
        'endereco',
        'bairro',
        'numero',
        'complemento',
        'contato',
        'tel_contato'
    ];
    
    protected $table = 'fornecedores';

}
