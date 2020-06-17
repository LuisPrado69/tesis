<?php

namespace App\Repositories\Repository\System;

use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use App\Models\System\Notification;

/**
 * Class NotificationRepository
 * @package App\Repositories\Repository
 */
class NotificationRepository extends Repository
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * NotificationRepository constructor.
     * @param App $app
     * @param UserRepository $userRepository
     * @throws RepositoryException
     */
    public function __construct(App $app, UserRepository $userRepository)
    {
        parent::__construct($app);
        $this->userRepository = $userRepository;
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Notification::class;
    }

    /**
     * @param     $id
     * @param int $n
     *
     * @return mixed
     */
    public function getLastNNotifications($id, $n = 5)
    {
        return $this->model->whereHas('recipients', function ($query) use ($id) {
            $query->where([
              'users.id' => $id,
              'read' => 0
            ]);
        })->latest()->limit($n)->get();
    }

    /**
     * Get a collection of models by notification Id
     *
     * @param array $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Update entity from array of data
     *
     * @param array $data
     * @param null $entity
     *
     * @return mixed
     * @throws ModelException
     */
    public function updateFromArray(array $data, $entity)
    {

        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        if (isset($data['sender_id'])) {
            $entity->sender_id = $data['sender_id'];
        }
        if (isset($data['subject'])) {
            $entity->subject = $data['subject'];
        }
        if (isset($data['body'])) {
            $entity->body = $data['body'];
        }
        $entity->save();
        $entity->recipients()->attach($data['recipients']);
        return $entity->fresh();
    }

    /**
     * Update entity from array of data
     *
     * @param Notification $notification
     * @param $user_id
     * @return mixed
     */
    public function markAsRead(Notification $notification, $user_id)
    {
        return $notification->recipients()->updateExistingPivot($user_id, ['read' => 1]);
    }

    /**
     * Create entity from array of data
     *
     * @param array $data
     *
     * @return mixed
     * @throws ModelException
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $this->updateFromArray($data, $entity);
    }

    /**
     * @param     $subject
     * @param     $body
     * @param     $recipients
     * @param int $sender_id . Default is the user with ID = 3 (Systems's user)
     *
     * @return bool
     * @throws \Exception
     */
    public function sendNotification($subject, $body, $recipients, $sender_id = 3)
    {
        try {
            $entity = $this->createFromArray([
                'subject' => $subject,
                'body' => $body,
                'recipients' => $recipients,
                'sender_id' => $sender_id
            ]);
            if (!$entity) {
                return false;
            }
            return true;
        } catch (\Throwable $e) {
            return false;
        }
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
        if (!$entity instanceof Model)
            throw new ModelException($this->model());
        return $entity->delete();
    }
}