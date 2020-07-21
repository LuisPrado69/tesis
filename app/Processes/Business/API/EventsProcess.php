<?php

namespace App\Processes\Business\API;

use App\Repositories\Repository\Business\EventsUserRepository;
use App\Repositories\Repository\Business\EventsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class EventsProcess
 * @package App\Processes\Business\API
 */
class EventsProcess
{

    /**
     * @var EventsRepository
     */
    protected $eventsRepository;

    /**
     * @var EventsUserRepository
     */
    protected $eventsUserRepository;

    /**
     * Constructor to CategoryController.
     *
     * @param EventsRepository $eventsRepository
     * @param EventsUserRepository $eventsUserRepository
     */
    public function __construct(
        EventsRepository $eventsRepository,
        EventsUserRepository $eventsUserRepository
    ) {
        $this->eventsRepository = $eventsRepository;
        $this->eventsUserRepository = $eventsUserRepository;
    }

    /**
     * Show index view from model.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function searchUserId(Request $request)
    {
        $data = $request->all();
        $eventsUser = $this->eventsUserRepository->findByField('user_id', $data['userId']);
        $eventsCategoryUser = $this->eventsRepository->searchUserId($data['userId']);
        if (count($eventsUser)) {
            $response = $eventsCategoryUser->map(function ($event) use ($eventsUser) {
                return [
                    'id' => $event->id,
                    'name' => $event->name,
                    'description' => $event->description,
                    'date' => $event->date,
                    'url' => $event->url,
                    'location_name' => $event->location_name,
                    'available' => self::verifyCategory($eventsUser, $event->id)
                ];
            });
        } else {
            $response = $eventsCategoryUser->map(function ($event) {
                return [
                    'id' => $event->id,
                    'name' => $event->name,
                    'description' => $event->description,
                    'date' => $event->date,
                    'url' => $event->url,
                    'location_name' => $event->location_name,
                    'available' => false
                ];
            });
        }
        return $response;
    }

    /**
     * @param $userEvents
     * @param $eventId
     *
     * @return bool
     */
    private function verifyCategory($userEvents, $eventId)
    {
        $validate = false;
        foreach ($userEvents as $userEvent) {
            if ($userEvent->id === $eventId) {
                $validate = true;
                break;
            }
        }
        return $validate;
    }

    /**
     * Show index view from model.
     *
     * @param Request $request
     *
     * @return array[]
     */
    public function updateUserId(Request $request)
    {
        $data = $request->all();
        $userCategories = $this->eventsUserRepository->searchUserIdField($data['userId'], $data['eventId']);
        if ($userCategories) {
            $this->eventsUserRepository->delete($userCategories->id);
        } else {
            $dataUserEvent = [
                'event_id' => $data['eventId'],
                'user_id' => $data['userId']
            ];
            $this->eventsUserRepository->createFromArray($dataUserEvent);
        }
        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('events.messages.success.updated')
            ]
        ];
        return $response;
    }
}