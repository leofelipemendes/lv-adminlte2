<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ContasBancariaRepository;
use App\Entities\ContasBancaria;
use App\Validators\ContasBancariaValidator;

/**
 * Class ContasBancariaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContasBancariaRepositoryEloquent extends BaseRepository implements ContasBancariaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContasBancaria::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ContasBancariaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
