<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PlanoContaRepository;
use App\Entities\PlanoConta;
use App\Validators\PlanoContaValidator;

/**
 * Class PlanoContaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PlanoContaRepositoryEloquent extends BaseRepository implements PlanoContaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PlanoConta::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PlanoContaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
