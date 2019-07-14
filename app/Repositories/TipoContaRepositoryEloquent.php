<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoContaRepository;
use App\Entities\TipoConta;
use App\Validators\TipoContaValidator;

/**
 * Class TipoContaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoContaRepositoryEloquent extends BaseRepository implements TipoContaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoConta::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TipoContaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
