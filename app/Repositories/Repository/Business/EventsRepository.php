<?php

namespace App\Repositories\Repository\Business;

use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Collection;
use App\Models\Business\Events;
use Illuminate\Support\Facades\DB;

/**
 * Class EventsRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class EventsRepository extends Repository
{

    /**
     * Constructor to EventsRepository.
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
        return Events::class;
    }

    /**
     * Update in database information to field.
     *
     * @param array $data
     * @param Events $entity
     *
     * @return Events|null
     */
    public function updateFromArray(array $data, Events $entity)
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
        if (!$entity instanceof Events) {
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
        return $this->model
            ->where([
                'status' => 1
            ])
            ->whereDate('date_start', '<=', Date::now())
            ->whereDate('date_end', '>=', Date::now())
            ->get();
    }

    /**
     * Find only active from this model.
     *
     * @param int $userId
     *
     * @return mixed
     */
    public function searchUserId(int $userId)
    {
        return $this->model
            ->join('category', 'events.category_id', 'category.id')
            ->join('category_user', 'category_user.category_id', 'category.id')
            ->join('location', 'events.location_id', 'location.id')
            ->where([
                'category_user.user_id' => $userId,
                'events.status' => 1,
            ])
            ->whereDate('date_start', '<=', Date::now())
            ->whereDate('date_end', '>=', Date::now())
            ->select('events.*', 'location.name as location_name', 'location.latitude', 'location.longitude')
            ->get();
    }

    /**
     * Find emails by rol ACC
     *
     * @param int $categoryId
     *
     * @return mixed
     */
    public function findCategoryUser(int $categoryId)
    {
        return $this->model
            ->join('category', 'events.category_id', '=', 'category.id')
            ->join('category_user', 'category_user.category_id', '=', 'category.id')
            ->join('users', 'users.id', '=', 'category_user.user_id')
            ->join('location', 'location.id', '=', 'events.location_id')
            ->select('users.email',
                DB::raw('CONCAT(users.last_name, " ", users.first_name) AS fullname'),
                DB::raw('(6371*ACOS(COS(RADIANS(users.latitude))*COS(RADIANS(location.latitude))*COS(RADIANS(location.longitude)-RADIANS(users.latitude))+SIN(RADIANS(users.latitude))*SIN(RADIANS(location.latitude)))+2.5) AS distance')
            )
            ->distinct('users.email', DB::raw('CONCAT(users.last_name, " ", users.first_name) AS fullname'))
            ->where('events.category_id', $categoryId)->get()->toArray();
    }
}