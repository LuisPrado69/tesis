<?php

namespace App\Repositories\Repository\Business;

use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use App\Models\Business\EventsUser;
use Illuminate\Support\Collection;

/**
 * Class EventsUserRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class EventsUserRepository extends Repository
{

    /**
     * Constructor to EventsUserRepository.
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
        return EventsUser::class;
    }

    /**
     * Update in database information to field.
     *
     * @param array $data
     * @param EventsUser $entity
     *
     * @return EventsUser|null
     */
    public function updateFromArray(array $data, EventsUser $entity)
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
     * @param int $eventId
     *
     * @return mixed
     */
    public function searchUserIdField(int $userId, int $eventId)
    {
        return $this->model
            ->where([
                'user_id' => $userId,
                'event_id' => $eventId
            ])
            ->first();
    }
}