<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ContasBancaria.
 *
 * @package namespace App\Entities;
 */
class ContasBancaria extends Model implements Transformable
{
    use TransformableTrait,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao',
        'idbanco',
        'agencia',
        'dig_ag',
        'nr_conta',
        'dig_conta',
        'tipo_conta',
        'finalidade',
        'ativo'
    ];

}
