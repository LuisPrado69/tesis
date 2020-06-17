<?php

namespace App\Repositories\Library\Contracts;


use app\Repositories\Library\Criteria\Criteria;

interface ICriteriaInterface
{
    /**
     * @param bool $status
     *
     * @return $this
     */
    public function skipCriteria($status = true);

    /**
     * @return mixed
     */
    public function getCriteria();

    /**
     * @param Criteria $criteria
     * @param array $params
     *
     * @return $this
     */
    public function getByCriteria(Criteria $criteria, array $params);

    /**
     * @param Criteria $criteria
     * @param array $params
     *
     * @return $this
     */
    public function pushCriteria(Criteria $criteria, array $params);

    /**
     * @return $this
     */
    public function applyCriteria();

}