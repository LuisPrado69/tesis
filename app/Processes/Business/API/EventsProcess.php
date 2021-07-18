<?php

namespace App\Processes\Business\API;

use App\Repositories\Repository\Business\EventsUserRepository;
use App\Repositories\Repository\Business\EventsRepository;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_Event;
use Illuminate\Http\JsonResponse;
use App\Models\Business\Events;
use Google_Service_Exception;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use http\Exception;
use Google_Client;
use DateInterval;
use DateTime;

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
        $eventsCategoryUser = $this->eventsRepository->searchUserId(intval($data['userId']));
        if (count($eventsUser)) {
            $response = $eventsCategoryUser->map(function ($event) use ($eventsUser) {
                return [
                    'id' => $event->id,
                    'name' => $event->name,
                    'description' => $event->description,
                    'date' => $event->date,
                    'url' => $event->url,
                    'location_name' => $event->location_name,
                    'latitude' => $event->latitude,
                    'longitude' => $event->longitude,
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
                    'latitude' => $event->latitude,
                    'longitude' => $event->longitude,
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
            if ($userEvent->event_id === $eventId) {
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
     * @throws \Exception
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
            $event = $this->eventsRepository->find($data['eventId']);
            self::createEventGoogleCalendar($event);
        }
        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('events.messages.success.updated')
            ]
        ];
        return $response;
    }

    /**
     * Create event google calendar.
     *
     * @param Events $event
     *
     * @throws \Exception
     */
    private function createEventGoogleCalendar(Events $event){
        date_default_timezone_set('America/Guayaquil');
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes(['https://www.googleapis.com/auth/calendar']);
        // Id calendar
        $id_calendar = env('ID_CALENDAR');
        $datetime_start = new DateTime($event->date);
        $datetime_end = new DateTime($event->date);
        // Add one hour to date
        $time_end = $datetime_end->add(new DateInterval('PT1H'));
        //datetime must be format RFC3339
        $time_start = $datetime_start->format(\DateTime::RFC3339);
        $time_end = $time_end->format(\DateTime::RFC3339);
        $eventName = $event->name;
        try {
            $calendarService = new Google_Service_Calendar($client);
            //Insert events
            $event = new Google_Service_Calendar_Event();
            $event->setSummary($eventName);
            $event->setDescription($event->description);
            //Start date
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($time_start);
            $event->setStart($start);
            //End Date
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($time_end);
            $event->setEnd($end);
            $optionalArguments = array("sendNotifications"=>true);
            $calendarService->events->insert($id_calendar, $event, $optionalArguments);
        } catch (Google_Service_Exception $gs) {
            $m = json_decode($gs->getMessage());
            $m = $m->error->message;
        } catch (Exception $e) {
            $m = $e->getMessage();
        }
    }
}