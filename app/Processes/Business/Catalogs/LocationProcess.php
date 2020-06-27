<?php

namespace App\Processes\Business\Catalogs;

use App\Repositories\Repository\Business\Catalogs\LocationRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Models\System\Setting;
use Illuminate\Http\Request;
use Exception;

/**
 * Class LocationProcess
 * @package App\Processes\Business\Catalogs
 */
class LocationProcess
{

    /**
     * @var LocationRepository
     */
    protected $locationRepository;

    /**
     * Constructor to LocationProcess.
     *
     * @param LocationRepository $locationRepository
     */
    public function __construct(
        LocationRepository $locationRepository
    ) {
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
        if ($user->can('edit.location.catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.location.catalogs',
                'tooltip' => trans('location.labels.edit')
            ];
        }
        $query = $this->locationRepository->all();
        return DataTables::of($query)
            ->setRowId('id')
            ->addColumn('enabled', function ($entity) use ($user) {
                $checked = $entity->status ? 'checked' : '';
                if ($user->can('enable_disable.location.catalogs')) {
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
        $entity = $this->locationRepository->createFromArray($data);
        if (!$entity) {
            throw new Exception(trans('location.messages.errors.create'), 1000);
        }
        return $entity;
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
        $entity = $this->locationRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('location.messages.errors.create'), 1000);
        }
        return [
            'entity' => $entity
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
        $entity = $this->locationRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('location.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->locationRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('location.messages.errors.update'), 1000);
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
        $entity = $this->locationRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('location.messages.exceptions.not_found'), 1000);
        }
        if (!$this->locationRepository->changeStatus($entity)) {
            throw new Exception(trans('location.messages.errors.update'), 1000);
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
            $result = $this->locationRepository->exists(['name' => $request->name], $request->id);
        } else {
            $result = $this->locationRepository->exists(['name' => $request->name]);
        }
        return $result;
    }
}