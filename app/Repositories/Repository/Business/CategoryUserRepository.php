<?php

namespace App\Repositories\Repository\Business;

use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use App\Models\Business\CategoryUser;
use Illuminate\Support\Collection;


/**
 * Class CategoryUserRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class CategoryUserRepository extends Repository
{

    /**
     * Constructor to CategoryUserRepository.
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
        return CategoryUser::class;
    }

    /**
     * Update in database information to field.
     *
     * @param array $data
     * @param CategoryUser $entity
     *
     * @return CategoryUser|null
     */
    public function updateFromArray(array $data, CategoryUser $entity)
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
     * Find this register by $userId
     *
     * @param int $userId
     * @param int $categoryId
     *
     * @return mixed
     */
    public function searchUserIdField(int $userId, int $categoryId)
    {
        return $this->model
            ->where([
                'user_id' => $userId,
                'category_id' => $categoryId
            ])
            ->first();
    }
}