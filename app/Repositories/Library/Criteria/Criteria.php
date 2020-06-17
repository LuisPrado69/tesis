<?php

namespace App\Repositories\Library\Criteria;


use App\Repositories\Library\Contracts\IRepositoryInterface as Repository;

abstract class Criteria
{
    /**
     * @param            $model
     * @param Repository $repository
     * @param array $params
     *
     * @return mixed
     */
    public abstract function apply($model, Repository $repository, array $params);
}