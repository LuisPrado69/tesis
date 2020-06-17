<?php

namespace App\Processes\Admin;

use App\Repositories\Repository\Configuration\PermissionRepository;
use App\Repositories\Repository\Configuration\RoleRepository;
use Illuminate\Http\Request;
use App\Models\System\Role;
use DataTables;
use Exception;
use Throwable;

/**
 * Class RoleProcess
 * @package App\Processes\Admin
 */
class RoleProcess
{

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return string
     */
    public function process()
    {
        return 'App\Processes\Admin\RoleProcess';
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('show.roles')) {
            $actions['search'] = [
                'route' => 'show.roles',
                'tooltip' => trans('app.labels.details')
            ];
        }

        if ($user->can('edit.roles')) {
            $actions['edit'] = [
                'route' => 'edit.roles',
                'tooltip' => trans('app.labels.edit')
            ];
        }

        if ($user->can('permissions.roles')) {
            $actions['list-ol'] = [
                'route' => 'permissions.roles',
                'tooltip' => trans('roles.labels.permissions')
            ];
        }

        if ($user->can('destroy.users')) {
            $actions['trash'] = [
                'route' => 'destroy.roles',
                'tooltip' => trans('roles.labels.delete'),
                'confirm_message' => trans('roles.messages.confirm.delete'),
                'method' => 'delete',
                'btn_class' => 'btn-danger'
            ];
        }

        $dataTable = Datatables::of(Role::where([
            ['slug', '<>', 'developer'],
            ['slug', '<>', 'administrator']
        ])->get())
            ->setRowId('id')
            ->addColumn('bulk_action', function ($entity) {
                return "<input type='checkbox' name='table_records' class='bulk check-one' value='{$entity->id}' />";
            })
            ->editColumn('enabled', function ($entity) use ($user) {
                $checked = $entity->enabled ? 'checked' : '';
                if ($user->can('status.roles') && $entity->editable) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                } else {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' disabled {$checked}/></label>";
                }
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                if (!$entity->editable) {
                    unset($actions['edit']);
                    unset($actions['list-ol']);
                }
                return view('layout.partial.datatable_action', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['bulk_action', 'actions', 'updated_at', 'enabled'])
            ->make(true);
        return $dataTable;
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $entity = $this->roleRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('app.messages.exceptions.unexpected'));
        }
        $response = [
            'view' => view('admin.role.permission', [
                'entity' => $entity
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('roles.messages.success.created')
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
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'));
        }
        $users = $entity->users()->get();
        $response['modal'] = view('admin.role.show', [
            'entity' => $entity,
            'users' => $users
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
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'));
        }
        $response['view'] = view('admin.role.update', [
            'entity' => $entity
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
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->roleRepository->updateFromArray($request->all(), $entity);
        $response = [
            'view' => view('admin.role.index', [
                'entity' => $entity
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('roles.messages.success.updated')
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
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);
        }
        try {
            $response = $this->roleRepository->delete($entity);
            if ($response === 'users_exist') {
                $response = [
                    'view' => view('admin.role.index')->render(),
                    'message' => [
                        'type' => 'error',
                        'text' => trans('roles.messages.errors.has_users', ['entities' => $entity->name])
                    ]
                ];
                return $response;
            } else {
                $response = [
                    'view' => view('admin.role.index')->render(),
                    'message' => [
                        'type' => 'success',
                        'text' => trans('roles.messages.success.deleted')
                    ]
                ];
                return $response;
            }
        } catch (Throwable $e) {
            return $response = defaultCatchHandler($e);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function bulkDestroy(Request $request)
    {
        $entities = $this->roleRepository->findByIds($request->ids);

        foreach ($entities as $entity) {
          $roleDeleted = $this->roleRepository->delete($entity);
          if($roleDeleted === 'users_exist') {
              $role = $entity;
              break;
          }
        }
        if ($roleDeleted === 'users_exist') {
            $response['message'] = [
                'type' => 'error',
                'text' => trans('roles.messages.errors.has_users', ['entities' => $role->name])
            ];
            return $response;
        } else {
            $response['message'] = [
                'type' => 'success',
                'text' => trans('roles.messages.success.deleted_bulk')
            ];
            return $response;
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function status($id)
    {
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);
        }
        if (!$this->roleRepository->changeStatus($entity)) {
            throw new Exception(trans('app.messages.exceptions.unexpected'), 1000);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('roles.messages.success.updated')
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
        $entities = $this->roleRepository->findByIds($request->ids);
        foreach ($entities as $entity) {
            $this->roleRepository->changeStatus($entity);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('roles.messages.success.updated_bulk')
        ];
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function editable($id)
    {
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);
        }
        if (!$this->roleRepository->changeEditable($entity)) {
            throw new Exception(trans('app.messages.exceptions.unexpected'), 1000);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('roles.messages.success.updated')
        ];
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function permissions($id)
    {
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'));
        }
        $response['view'] = view('admin.role.permission', [
            'entity' => $entity
        ])->render();
        return $response;
    }
    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function onePermissions(Request $request)
    {
        $role = $request->role;
        $entity = $this->roleRepository->findBy('slug', $role);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);
        }
        if ($request->base_second) {
            $action = $request->base;
            $base = $request->base_second;
        } else {
            $action = $request->action;
            $base = $request->base;
        }
        $inherit = $base . '.' . $role;
        $permission = $this->permissionRepository->findBy('name', $inherit);
        if (!$permission) {
            $parent = $this->permissionRepository->findBy('name', $base);
            if ($parent) {
                $permission = $this->permissionRepository->create([
                    'inherit_id' => $parent->id,
                    'module_id' => $parent->module_id,
                    'name' => $inherit,
                    'description' => trans('roles.labels.permissions_over', ['name' => $entity->name, 'label' => $parent->label]),
                    'slug' => $parent->slug,
                    'label' => $parent->label
                ]);
                $permission = $permission->fresh();
                $entity->assignPermission([$permission]);
            }
        }
        if ($request->base_sixth) {
            $this->roleRepository->changePermission($permission, $request->base_third, $request->base_fourth, $request->base_fifth, $request->base_sixth, $request->base,
                $request->action);
        } elseif ($request->base_fifth) {
            $this->roleRepository->changePermission($permission, $request->base_third, $request->base_fourth, $request->base_fifth, $request->base, $request->action);
        } elseif ($request->base_fourth) {
            $this->roleRepository->changePermission($permission, $request->base_third, $request->base_fourth, $request->base, $request->action);
        } elseif ($request->base_third) {
            $this->roleRepository->changePermission($permission, $request->base_third, $request->base, $request->action);
        } elseif ($request->base_second) {
            $this->roleRepository->changePermission($permission, $action, $request->action);
        } else {
            $this->roleRepository->changePermission($permission, $action);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('roles.messages.success.permissions')
        ];
        return $response;
    }

    /**
     * @param $name
     * @param $id
     * @return bool
     */
    public function checkNameExists($name, $id)
    {
        $result = $this->roleRepository->exists(['name' => $name], $id);
        return $result;
    }

    /**
     * Change or create all permissions
     *
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function allPermissions(Request $request)
    {
        $role = $request->role;
        $entity = $this->roleRepository->findBy('slug', $role);
        if (!$entity) {
            throw new Exception(trans('configuration.role.messages.exceptions.not_found'), 1000);
        }
        if ($request->base_second) {
            $base = $request->base_second;
        } else {
            $base = $request->base;
        }
        $parent = $this->permissionRepository->findBy('name', $base);
        if (!$parent) {
            throw new Exception(trans('configuration.role.messages.exceptions.not_parent'), 1000);
        }
        $inherit = $base . '.' . $role;
        $permission = $this->permissionRepository->findBy('name', $inherit);
        if (!$permission) {
            $permission = $this->permissionRepository->create([
                'inherit_id' => $parent->id,
                'module_id' => $parent->module_id,
                'name' => $inherit,
                'description' => trans('roles.labels.permissions_over', ['name' => $entity->name, 'label' => $parent->label]),
                'slug' => $parent->slug,
                'label' => $parent->label
            ]);
            $permission = $permission->fresh();
            $entity->assignPermission([$permission]);
        }
        $checked = $request->checked == 'true';
        if ($request->base_sixth) {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base_third, $request->base_fourth, $request->base_fifth,
                $request->base_sixth, $request->base);
        } elseif ($request->base_fifth) {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base_third, $request->base_fourth, $request->base_fifth, $request->base);
        } elseif ($request->base_fourth) {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base_third, $request->base_fourth, $request->base);
        } elseif ($request->base_third) {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base_third, $request->base);
        } elseif ($request->base_second) {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base);
        } else {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('configuration.role.messages.success.permissions')
        ];
        return $response;
    }
}