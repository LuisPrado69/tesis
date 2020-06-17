<?php

namespace App\Processes\System;

use App\Repositories\Repository\System\NotificationRepository;
use App\Repositories\Repository\Admin\UserRepository;
use Illuminate\Http\Request;
use Throwable;
use Exception;

/**
 * Class NotificationProcess
 * @package App\Processes\System
 */
class NotificationProcess
{

    /**
     * @var NotificationRepository
     */
    protected $notificationRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * NotificationProcess constructor.
     * @param NotificationRepository $notificationRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        NotificationRepository $notificationRepository,
        UserRepository $userRepository
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param null $id
     * @return mixed
     * @throws Throwable
     */
    public function index($id = null)
    {
        $notification = null;
        if (null !== $id) {
            $notification = $this->notificationRepository->find($id);
            if ($notification) {
                $this->notificationRepository->markAsRead($notification, currentUser()->id);
            }
        }
        $response['view'] = view('notification.index', [
            'notifications' => currentUser()->latestNotifications(),
            'notification_id' => null !== $notification ? $notification->id : ''
        ])->render();
        return $response;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function store(Request $request)
    {
        if (!$this->notificationRepository->sendNotification($request->subject, $request->body, $request->users, currentUser()->id)) {
            throw new Exception(trans('notification.messages.errors.create'), 1000);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('notification.messages.success.created')
        ];
        $response['view'] = view('notification.index', [
            'notifications' => currentUser()->latestNotifications(),
            'notification_id' => $request->notification_id
        ])->render();
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Throwable
     */
    public function show($id)
    {
        $entity = $this->notificationRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('notification.messages.exception.not_found'), 1000);
        }
        $this->notificationRepository->markAsRead($entity, currentUser()->id);
        $response['view'] = view('notification.details', [
            'notification' => $entity
        ])->render();
        return $response;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $entity = $this->notificationRepository->find($request->id);
        if (!$entity) {
            throw new Exception(trans('notification.messages.exception.not_found'), 1000);
        }
        if (!$this->notificationRepository->delete($entity)) {
            throw new Exception(trans('notification.messages.errors.delete'), 1000);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('notification.messages.success.deleted')
        ];
        return $response;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function searchUser(Request $request)
    {
        $response['data'] = $this->userRepository->findByFullNameLike($request->q);
        return $response;
    }

}