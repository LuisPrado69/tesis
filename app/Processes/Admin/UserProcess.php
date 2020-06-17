<?php

namespace App\Processes\Admin;


use App\Repositories\Repository\Configuration\RoleRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Models\System\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Exception;
use Throwable;

/**
 * Class UserProcess
 * @package App\Processes\Admin
 */
class UserProcess
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * UserProcess constructor.
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return string
     */
    public function process()
    {
        return 'App\Processes\Admin\UserProcess';
    }


    /**
     * Charge data from users.
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('show.users')) {
            $actions['search'] = [
                'route' => 'show.users',
                'tooltip' => trans('users.user.labels.details')
            ];
        }
        if ($user->can('edit.users')) {
            $actions['edit'] = [
                'route' => 'edit.users',
                'tooltip' => trans('users.user.labels.update')
            ];
        }
        if ($user->can('password.users')) {
            $actions['key'] = [
                'route' => 'password.users',
                'tooltip' => trans('app.labels.change_password')
            ];
        }
        if ($user->can('destroy.users')) {
            $actions['trash'] = [
                'route' => 'destroy.users',
                'tooltip' => trans('users.user.labels.delete'),
                'confirm_message' => trans('users.user.messages.confirm.delete'),
                'method' => 'delete',
                'btn_class' => 'btn-danger'
            ];
        }
        $dataTable = DataTables::eloquent($this->userRepository->findVisible())
            ->setRowId('id')
            ->addColumn('updated_at', function ($entity) {
                Carbon::setLocale(config('app.locale'));
                return $entity->updated_at->diffForHumans();
            })
            ->editColumn('enabled', function (User $entity) use ($user) {
                $checked = $entity->enabled ? 'checked' : '';
                $role = $entity->roles()->first();
                if ($entity->id != $user->id) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                } elseif ($user->can('status.users') && $entity->id != $user->id ) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                } else {
                    return "";
                }
            })
            ->addColumn('name', function (User $entity) {
                return $entity->fullNameWithLastNameFirst();
            })
            ->addColumn('role', function (User $entity) {
                return $entity->roles->first() ? $entity->roles->first()->name : '';
            })
            ->addColumn('bulk_action', function (User $entity) use ($user) {
                if ($entity->id == $user->id) {
                    return "";
                }

                return "<input type='checkbox' name='table_records' class='bulk check-one' value='{$entity->id}' />";
            })
            ->addColumn('actions', function (User $entity) use ($actions, $user) {
                $aux = $actions;
                $role = $entity->roles()->first();
                if ($entity->id === $user->id) {
                    unset($aux['trash']);
                    unset($aux['key']) ;
                 }

                return view('layout.partial.datatable_action', [
                    'entity' => $entity,
                    'actions' => $aux
                ]);
            })
            ->rawColumns(['updated_at', 'bulk_action','enabled', 'actions'])
            ->make(true);

        return $dataTable;
    }

    /**
     * @return mixed
     * @throws Throwable
     */
    public function create()
    {
        $roles = $this->roleRepository->findAssignable();
        if (!$roles) {
            throw new Exception($this->process());
        }

        $response['view'] = view('admin.user.create', [
            'roles' => $roles
        ])->render();

        return $response;
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $entity = $this->userRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('users.user.messages.errors.create'), 1000);
        }
        $response = [
            'view' => view('admin.user.index', [
                'entity' => $entity
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('users.user.messages.success.created')
            ]
        ];
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function show($id)
    {
        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }
        $response['modal'] = view('admin.user.show', [
            'entity' => $entity
        ])->render();
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function edit($id)
    {

        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }
        $roles = $this->roleRepository->findAssignable();
        $entityRolesIds = $entity->roles()->pluck('roles.id')->all();
        $response['view'] = view('admin.user.update', [
            'entity' => $entity,
            'roles' => $roles,
            'entityRolesIds' => $entityRolesIds
        ])->render();
        return $response;
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function update(Request $request, $id)
    {
        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->userRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('users.user.messages.errors.update'), 1000);
        }
        $response = [
            'view' => view('admin.user.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('users.user.messages.success.updated')
            ]
        ];
        return $response;
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function destroy($id)
    {
        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }
        if (!$this->userRepository->delete($entity)) {
            throw new Exception(trans('users.user.messages.errors.delete'), 1000);
        }
        $response = [
            'view' => view('admin.user.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('users.user.messages.success.deleted')
            ]
        ];
        return $response;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function bulkDestroy(Request $request)
    {
        $entities = $this->userRepository->findByIds($request->ids);
        foreach ($entities as $entity) {
            $this->userRepository->delete($entity);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('users.user.messages.success.deleted_bulk')
        ];
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function status($id)
    {
        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }
        if (!$this->userRepository->changeStatus($entity)) {
            throw new Exception(trans('users.user.messages.errors.update'), 1000);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('users.user.messages.success.updated')
        ];
        return $response;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function bulkStatus(Request $request)
    {
        $entities = $this->userRepository->findByIds($request->ids);
        foreach ($entities as $entity) {
            $this->userRepository->changeStatus($entity);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('users.user.messages.success.updated_bulk')
        ];
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Throwable
     */
    public function changePassword($id)
    {
        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }
        $response['modal'] = view('admin.user.password', [
            'entity' => $entity
        ])->render();
        return $response;
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function updatePassword(Request $request)
    {
        $entity = $this->userRepository->find($request->user_id);
        if (!$entity) {
            throw new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }
        if (!$this->userRepository->changePassword($request->all(), $entity)) {
            throw new Exception(trans('users.user.messages.errors.password'), 1000);
        }
        session(['changedPassword' => true]);
        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('users.user.messages.success.password_changed')
            ]
        ];
        return $response;
    }

    /**
     * Check if document exists
     *
     * @param Request $request
     * @return string
     */
    public function checkDocumentExists(Request $request)
    {
        if (isset($request->id)) {
            $result = $this->userRepository->exists(['document' => $request->document], $request->id);
        } else {
            $result = $this->userRepository->exists(['document' => $request->document]);
        }
        return $result;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function checkUsernameExists(Request $request)
    {
        if (isset($request->id)) {
            $result = $this->userRepository->exists(['username' => $request->username], $request->id);
        } else {
            $result = $this->userRepository->exists(['username' => $request->username]);
        }
        return $result;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function checkEmailExists(Request $request)
    {
        if (isset($request->id)) {
            $result = $this->userRepository->exists(['email' => $request->email], $request->id);
        } else {
            $result = $this->userRepository->exists(['email' => $request->email]);
        }
        return $result;
    }

}