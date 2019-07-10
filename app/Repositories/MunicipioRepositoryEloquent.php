<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MunicipioRepository;
use App\Entities\Municipio;
use App\Validators\MunicipioValidator;

/**
 * Class MunicipioRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MunicipioRepositoryEloquent extends BaseRepository implements MunicipioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Municipio::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MunicipioValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
