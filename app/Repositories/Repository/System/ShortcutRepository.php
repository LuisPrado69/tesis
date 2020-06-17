<?php

namespace App\Repositories\Repository\System;

use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Models\System\Shortcut;

/**
 * Class ShortcutRepository
 * @package App\Repositories\Repository\System
 */
class ShortcutRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Shortcut::class;
    }

    /**
     * Get a collection of models by user Id
     *
     * @param array $id
     * @param int $limit
     * @return mixed
     */
    public function findByUserId($id, $limit = -1)
    {
        if ($limit == -1) {
            return $this->model->where('user_id', $id)->get();
        } else {
            return $this->model->where('user_id', $id)->orderBy('id', 'desc')->take($limit)->get();
        }
    }

    /**
     * Get a collection of models by user Id
     *
     * @param array $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Get a collection of models by array of ids
     *
     * @param array $ids
     * @param array $columns
     * @return mixed
     */
    public function findByIds(array $ids, $columns = ['*'])
    {
        return $this->model->whereIn('id', $ids)->get($columns);
    }

    /**
     * Update entity from array of data
     *
     * @param array $data
     * @param null $entity
     * @return mixed
     * @throws ModelException
     */
    public function updateFromArray(array $data, $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        if (isset($data['name'])) {
            $entity->name = $data['name'];
        }
        if (isset($data['URL'])) {
            $entity->URL = $data['URL'];
        }
        if (isset($data['user_id'])) {
            $entity->user_id = $data['user_id'];
        }
        if (isset($data['widget_id'])) {
            $entity->widget_id = $data['widget_id'];
        }
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Create entity from array of data
     *
     * @param array $data
     * @return mixed
     * @throws ModelException
     */
    public function create(array $data)
    {
        $entity = new $this->model;
        return $this->updateFromArray($data, $entity);
    }

    /**
     * Delete model
     *
     * @param $entity
     * @return bool|null
     * @throws ModelException
     * @throws \Exception
     */
    public function delete($entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        return $entity->delete();
    }
}

