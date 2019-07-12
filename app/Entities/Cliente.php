<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cliente.
 *
 * @package namespace App\Entities;
 */
class Cliente extends Model implements Transformable
{
    use TransformableTrait,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'rg',
        'cpf',
        'endereco',
        'bairro',
        'numero',
        'complemento',
        'idmunicipio',
        'iduf',
        'ddd_res',
        'tel_res',
        'ddd_cel',
        'tel_cel',
        'ddd_out',
        'tel_out',
        'contato',
        'email'
    ];
    
    public function estado() {
        
        return $this->hasOne('App\Entities\Estado');
    }
    
    public function municipio() {
        
        return $this->hasOne('App\Entities\Municipio');
    }

}
