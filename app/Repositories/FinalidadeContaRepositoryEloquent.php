<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FinalidadeContaRepository;
use App\Entities\FinalidadeConta;
use App\Validators\FinalidadeContaValidator;

/**
 * Class FinalidadeContaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FinalidadeContaRepositoryEloquent extends BaseRepository implements FinalidadeContaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FinalidadeConta::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FinalidadeContaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
