<?php

namespace App\Repositories\Repository\Configuration;

use App\Models\System\Menu;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MenuRepository
 * @package App\Repositories\Repository\Configuration
 */
class MenuRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Menu::class;
    }

    /**
     * Get the parents menu
     *
     * @return mixed
     */
    public function findParents()
    {
        return $this->model
            ->whereNull('parent_id')
            ->where('enabled', true)
            ->orderBy('weight', 'asc')
            ->get();
    }

    /**
     * Get children for parent menu
     *
     * @param $parentId
     * @return mixed
     */
    public function findChildren($parentId)
    {
        return $this->model
            ->where('parent_id', $parentId)
            ->where('enabled', true)
            ->orderBy('weight', 'asc')
            ->get();
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
     * Get the children menus for one Menu.
     * @param $menuID
     * @return array
     */
    public function getChildrenMenu($menuID)
    {
        $menu = $this->find($menuID);
        if ($menu) {
            return $menu->children()->where('enabled', 1)->orderBy('weight', 'asc')->get();
        }
        return [];
    }

    /**
     * Get all parents menus.
     * @return array
     */
    public function getParentsMenu()
    {
        return $this->model->where('parent_id', null)->where('enabled', 1)->orderBy('weight', 'asc')->get();
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
        $entity->parent_id = $data['parent_id'];
        $entity->label = $data['label'];
        $entity->slug = $data['slug'];
        $entity->icon = $data['icon'];
        $entity->weight = $data['weight'];
        $entity->enabled = isset($data['enabled']) && $data['enabled'] == 'on';
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
    public function createFromArray(array $data)
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

    /**
     * Change the model status
     *
     * @param $entity
     * @return bool
     * @throws ModelException
     */
    public function changeStatus($entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        $entity->enabled = !$entity->enabled;
        return $entity->save();
    }
}