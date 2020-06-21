<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use App\Models\Business\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class CategoryRepository extends Repository
{

    /**
     * Constructor to CategoryRepository.
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
        return Category::class;
    }

    /**
     * Update in database information to field.
     *
     * @param array $data
     * @param Category $entity
     *
     * @return Category|null
     */
    public function updateFromArray(array $data, Category $entity)
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
        if (!$entity instanceof Category) {
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