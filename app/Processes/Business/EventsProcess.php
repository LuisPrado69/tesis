<?php

namespace App\Processes\Business;

use App\Repositories\Repository\Business\Catalogs\CategoryRepository;
use App\Repositories\Repository\Business\Catalogs\LocationRepository;
use App\Repositories\Repository\Business\EventsRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailForgotPassword;
use App\Mail\EventNotification;
use App\Models\Business\Events;
use App\Models\System\Setting;
use Illuminate\Http\Request;
use App\Models\System\User;
use Exception;

/**
 * Class EventsProcess
 * @package App\Processes\Business\Catalogs
 */
class EventsProcess
{

    /**
     * @var EventsRepository
     */
    protected $eventsRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var LocationRepository
     */
    protected $locationRepository;

    /**
     * Constructor to EventsProcess.
     *
     * @param EventsRepository $eventsRepository
     * @param CategoryRepository $categoryRepository
     * @param LocationRepository $locationRepository
     */
    public function __construct(
        EventsRepository $eventsRepository,
        CategoryRepository $categoryRepository,
        LocationRepository $locationRepository
    )
    {
        $this->eventsRepository = $eventsRepository;
        $this->categoryRepository = $categoryRepository;
        $this->locationRepository = $locationRepository;
    }

    /**
     * Load information to model.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];
        if ($user->can('edit.events')) {
            $actions['edit'] = [
                'route' => 'edit.events',
                'tooltip' => trans('events.labels.edit')
            ];
        }
        $query = $this->eventsRepository->all();
        return DataTables::of($query)
            ->setRowId('id')
            ->addColumn('enabled', function ($entity) use ($user) {
                $checked = $entity->status ? 'checked' : '';
                if ($user->can('enable_disable.events')) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                }
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions', 'enabled'])
            ->make(true);
    }

    /**
     * Save in database new model.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $entity = $this->eventsRepository->createFromArray($data);
        if (!$entity) {
            throw new Exception(trans('events.messages.errors.create'), 1000);
        }
        return $entity;
    }

    /**
     * Return view to edit model.
     *
     * @return array
     * @throws Exception
     */
    public function create()
    {
        $categories = $this->categoryRepository->findActive();
        if (!$categories) {
            throw new Exception(trans('events.messages.errors.create'), 1000);
        }
        $locations = $this->locationRepository->findActive();
        if (!$locations) {
            throw new Exception(trans('events.messages.errors.create'), 1000);
        }
        return [
            'categories' => $categories,
            'locations' => $locations
        ];
    }

    /**
     * Return view to edit model.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->eventsRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('events.messages.errors.create'), 1000);
        }
        $categories = $this->categoryRepository->findActive();
        if (!$categories) {
            throw new Exception(trans('events.messages.errors.create'), 1000);
        }
        $locations = $this->locationRepository->findActive();
        if (!$locations) {
            throw new Exception(trans('events.messages.errors.create'), 1000);
        }
        return [
            'entity' => $entity,
            'categories' => $categories,
            'locations' => $locations
        ];
    }

    /**
     * Update view to edit model.
     *
     * @param Request $request
     * @param int $id
     *
     * @return Setting|mixed|null
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $entity = $this->eventsRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('events.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->eventsRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('events.messages.errors.update'), 1000);
        }
        return $entity;
    }

    /**
     * Enable/ Disable this model.
     *
     * @param $id
     *
     * @return mixed
     * @throws Exception
     */
    public function status($id)
    {
        $entity = $this->eventsRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('events.messages.exceptions.not_found'), 1000);
        }
        if (!$this->eventsRepository->changeStatus($entity)) {
            throw new Exception(trans('events.messages.errors.update'), 1000);
        }
        return $entity;
    }

    /**
     * Check if name exists.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function checkNameExists(Request $request)
    {
        if (isset($request->id)) {
            $result = $this->eventsRepository->exists(['name' => $request->name], $request->id);
        } else {
            $result = $this->eventsRepository->exists(['name' => $request->name]);
        }
        return $result;
    }

    /**
     * Send email personal factory.
     *
     * @param Events $event
     */
    public function sendEmail(Events $event)
    {
        $email_notification = $this->eventsRepository->findCategoryUser((int)$event->category_id);
        if (count($email_notification)) {
            foreach ($email_notification as $data) {
                Mail::to($data['email'])->send(new EventNotification($event, $data['fullname']));
            }
        }
    }

    /**
     * Send email personal factory.
     *
     * @param User $user
     */
    public function sendEmailForgotPassword(User $user)
    {
        Mail::to($user->email)->send(new EmailForgotPassword($user->fullName()));
    }
}