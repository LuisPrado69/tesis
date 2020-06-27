<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use App\Models\Business\Location;

/**
 * Class LocationRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class LocationRepository extends Repository
{

    /**
     * Constructor to LocationRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * Specific name of model.
     *
     * @return mixed|string
     */
    function model()
    {
        return Location::class;
    }

    /**
     * Update in database information to field.
     *
     * @param array $data
     * @param Location $entity
     *
     * @return Location|null
     */
    public function updateFromArray(array $data, Location $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Create entity from array of data.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->create($data);
    }

    /**
     * Change model status.
     *
     * @param $entity
     *
     * @return bool|null
     * @throws ModelException
     */
    public function changeStatus($entity)
    {
        if (!$entity instanceof Location) {
            throw new ModelException($this->model());
        }
        $entity->status = !$entity->status;
        return $entity->save();
    }

    /**
     * Find only active from this model.
     *
     * @return mixed
     */
    public function findActive()
    {
        return $this->model->where([
            'status' => 1
        ])->get();
    }
}