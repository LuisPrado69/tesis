<?php

namespace App\Repositories\Repository\Admin;

use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Collection;

/**
 * Class UserRepository
 * @package App\Repositories\Repository
 */
class UserRepository extends Repository
{

    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\System\User';
    }

    /**
     * Get a collection of models with not developer role and superAdmin
     *
     * @return mixed
     */
    public function findVisible()
    {
        return $this->model
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('slug', ['developer']);
            })
            ->where([
                ['username', '<>', 'bot'],
                ['username', '<>', 'admin'],
            ]);
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

    public function findAll()
    {
        return $this->model->get();
    }

    public function findByFullNameLike($term)
    {
        return $this->model->where('first_name', 'like', '%' . $term . '%')->orWhere('last_name', 'like', '%' . $term . '%')->get(['id', 'first_name', 'last_name']);
    }

    public function findEnabledUsersByRoleSlug($slug)
    {
        return $this->model->whereHas('roles', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->where('enabled', 1)->orderBy('last_name', 'asc')->get();
    }

    public function findUsersByRoleSlug($slug)
    {
        return $this->model->whereHas('roles', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->orderBy('last_name', 'asc')->get();
    }

    /**
     * Count users
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Get trashed users
     */
    public function trashed()
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * @param $term
     * @return mixed
     */
    public function findByNameOrDocumentLike($term)
    {
        return $this->model
            ->where(function ($query) use ($term) {
                $query->where('first_name', 'like', '%' . $term . '%')
                    ->orWhere('last_name', 'like', '%' . $term . '%')
                    ->orWhere('document', 'like', '%' . $term . '%');
            })
            ->where('enabled', 1)
            ->get();
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
        if (isset($data['username'])) {
            $entity->username = $data['username'];
        }
        if (isset($data['first_name'])) {
            $entity->first_name = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $entity->last_name = $data['last_name'];
        }
        if (isset($data['document_type'])) {
            $entity->document_type = $data['document_type'];
        }
        if (isset($data['document'])) {
            $entity->document = $data['document'];
        }
        if (isset($data['email'])) {
            $entity->email = $data['email'];
        }
        if (isset($data['photo'])) {
            $photo = $data['photo'];
            $path = env('IMAGES_PATH');
            if ($entity->hasPhoto()) {
                $photoPath = $path . $entity->photo;
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
            $fileName = time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo->getRealPath())->resize(256, 256)->save($path . $fileName);
            $entity->photo = $fileName;
        }

        if (isset($data['password'])) {
            $entity->password = bcrypt($data['password']);
        }
        if (!isset($data['enabled'])) {
            $entity->enabled = 0;
        }
        if (isset($data['enabled'])) {
            $entity->enabled = isset($data['enabled']);
        }
        $entity->save();

        if (isset($data['roles'])) {
            $entity->roles()->sync($data['roles']);
        }
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
        $entity->remember_token = bcrypt(uniqid());
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
     * Change model status
     *
     * @param $entity
     * @return bool|null
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

    /**
     * Change password
     *
     * @param array $data
     * @param $entity
     * @return bool
     * @throws ModelException
     */
    public function changePassword(array $data, $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        if ($data['password']) {
            $entity->password = bcrypt($data['password']);
            if (isset($data['changed_password'])) {
                $entity->changed_password = $data['changed_password'];
            }
        }
        return $entity->save();
    }
}