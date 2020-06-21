<?php

use Illuminate\Database\Seeder;
use App\Models\System\User;

class Acl extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** ------------
         * Default roles
         * ------------- */
        // Administrator
        $administratorRoleSlug = 'administrator';
        $adminRole = config('acl.role')::create([
            'name' => 'Administrador del sistema',
            'slug' => $administratorRoleSlug,
            'description' => 'Administrador del sistema',
            'editable' => false
        ]);

        // Developer
        $devRoleSlug = 'developer';
        $devRole = config('acl.role')::create([
            'name' => 'Desarrollador',
            'slug' => $devRoleSlug,
            'description' => 'Gestionan el correcto funcionamiento del sistema',
            'editable' => false
        ]);

        /** ------------
         * Default users
         * ------------- */
        $admin = User::create([
            'id' => 1,
            'username' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'document_type' => 'RUC',
            'document' => '1111111111111',
            'email' => 'admin@sloncorp.com',
            'password' => bcrypt('adminpass'),
            'remember_token' => md5(uniqid()),
            'changed_password' => 1, //TODO: leave this in 0
            'enabled' => 1
        ]);

        $admin->assignRole($administratorRoleSlug);

        $dev = User::create([
            'id' => 2,
            'username' => 'developer',
            'first_name' => 'Developer',
            'last_name' => 'User',
            'document_type' => 'RUC',
            'document' => '2222222222222',
            'email' => 'developer@sloncorp.com',
            'password' => bcrypt('Crifa@123'),
            'remember_token' => md5(uniqid()),
            'changed_password' => 1, //TODO: leave this in 0
            'enabled' => 1
        ]);
        $dev->assignRole($devRole);

        User::create([
            'id' => 3,
            'username' => 'bot',
            'first_name' => 'Bot',
            'last_name' => 'User',
            'document_type' => 'RUC',
            'document' => '3333333333333',
            'email' => 'bot@sloncorp.com',
            'password' => bcrypt('Crifa@123'),
            'remember_token' => md5(uniqid()),
            'changed_password' => 1, //TODO: leave this in 0,
            'enabled' => 1
        ]);

        /** ------------------
         * Add all permissions to admin and developer roles
         * ------------------ */
        //Template Permissions
        $parentPermissions = $this->_buildPermissions(false);

        //Administrator Role Permissions
        $this->_buildPermissions(true, $parentPermissions, $adminRole);
        //Developer Role Permissions
        $this->_buildPermissions(true, $parentPermissions, $devRole);


        /** ------------------
         * Specific Role permissions
         * The following example shows how to add specific permissions to some Role:
         *
         * $this->_assignSpecificPermissions($myRole, Acl::$MY_ROLE_SPECIFIC_PERMISSIONS, $parentPermissions);
         *
         */
    }


    private static $SYSTEM_PERMISSIONS = [
        ['name' => 'roles', 'label' => 'Roles', 'show_to_users' => 1],
        ['name' => 'users', 'label' => 'Usuarios', 'show_to_users' => 1],
        ['name' => 'catalogs', 'label' => 'Catálogos', 'show_to_users' => 1],
        ['name' => 'events', 'label' => 'Eventos', 'show_to_users' => 1]
    ];

    /*
     * Specific permissions for some role.
     * 1. To add all permissions for some functionality. Use '*' wildcard
     * 2. to add specific permissions for some functionality, use an array.
     *
     private static $MY_ROLE_SPECIFIC_PERMISSIONS = [
        'users' => '*',
        'roles' => ['index', 'create'],
    ];
    */

    /**
     * START JSON tree for every permission. Name each function as [newPermissionName]_slugs
     *
     * 'order' => 1, -> Sort field when displaying permissions
     * 'is_primary' => 1, -> If you want to show your children you need a label for a child
     *
     */

    private function roles_slugs($allowed)
    {
        return [
            'index' => [
                'order' => 1,
                'allowed' => $allowed,
                'label' => 'Listar Roles',
                'inner' => [
                    'data' => ['allowed' => $allowed]
                ]
            ],
            'create' => [
                'order' => 2,
                'allowed' => $allowed,
                'label' => 'Crear roles',
                'inner' => [
                    'store' => ['allowed' => $allowed],
                    'checkname' => ['allowed' => $allowed]
                ]
            ],
            'show' => [
                'order' => 3,
                'allowed' => $allowed,
                'label' => 'Mostrar detalles de roles',
            ],
            'edit' => [
                'order' => 4,
                'allowed' => $allowed,
                'label' => 'Editar roles',
                'inner' => [
                    'update' => ['allowed' => $allowed],
                    'checkname' => ['allowed' => $allowed]
                ]
            ],
            'destroy' => [
                'order' => 5,
                'allowed' => $allowed,
                'label' => 'Eliminar roles',
                'inner' => [
                    'bulk' => ['allowed' => $allowed]
                ]
            ],
            'status' => [
                'order' => 6,
                'allowed' => $allowed,
                'label' => 'Habilitar/Inhabilitar roles',
                'inner' => [
                    'bulk' => ['allowed' => $allowed]
                ]
            ],
            'permissions' => [
                'order' => 7,
                'allowed' => $allowed,
                'label' => 'Editar permisos de roles',
                'inner' => [
                    'one' => ['allowed' => $allowed],
                    'all' => ['allowed' => $allowed]
                ]
            ]
        ];
    }

    private function users_slugs($allowed)
    {
        return [
            'index' => [
                'order' => 1,
                'allowed' => $allowed,
                'label' => 'Listar usuarios',
                'inner' => [
                    'data' => ['allowed' => $allowed]
                ]
            ],
            'create' => [
                'order' => 2,
                'allowed' => $allowed,
                'label' => 'Crear usuarios',
                'inner' => [
                    'store' => ['allowed' => $allowed],
                    'checkdocument' => ['allowed' => $allowed],
                    'checkusername' => ['allowed' => $allowed],
                    'checkemail' => ['allowed' => $allowed]
                ]
            ],
            'edit' => [
                'order' => 3,
                'allowed' => $allowed,
                'label' => 'Editar usuarios',
                'inner' => [
                    'update' => ['allowed' => $allowed],
                    'checkdocument' => ['allowed' => $allowed],
                    'checkusername' => ['allowed' => $allowed],
                    'checkemail' => ['allowed' => $allowed]
                ]
            ],
            'show' => [
                'order' => 4,
                'allowed' => $allowed,
                'label' => 'Mostrar detalles de usuarios'
            ],
            'destroy' => [
                'order' => 5,
                'allowed' => $allowed,
                'label' => 'Eliminar usuarios'
            ],
            'status' => [
                'order' => 6,
                'allowed' => $allowed,
                'label' => 'Habilitar/Inhabilitar usuarios',
                'inner' => [
                    'bulk' => ['allowed' => $allowed]
                ]
            ],
            'password' => [
                'order' => 7,
                'allowed' => $allowed,
                'label' => 'Cambiar contraseña de usuarios',
                'inner' => [
                    'update' => ['allowed' => $allowed]
                ]
            ]
        ];
    }

    private function catalogs_slugs($allowed)
    {
        return [
            'category' => [
                'allowed' => $allowed,
                'label' => 'Categorias',
                'is_primary' => 1,
                'order' => 1,
                'inner' => [
                    'index' => [
                        'allowed' => $allowed,
                        'order' => 1,
                        'label' => 'Listar categorias',
                        'inner' => [
                            'data' => ['allowed' => $allowed]
                        ]
                    ],
                    'create' => [
                        'allowed' => $allowed,
                        'order' => 2,
                        'label' => 'Crear categoria',
                        'inner' => [
                            'store' => ['allowed' => $allowed],
                            'verify' => ['allowed' => $allowed]
                        ]
                    ],
                    'edit' => [
                        'allowed' => $allowed,
                        'order' => 3,
                        'label' => 'Editar categoria',
                        'inner' => [
                            'update' => ['allowed' => $allowed],
                            'verify' => ['allowed' => $allowed]
                        ]
                    ],
                    'enable_disable' => [
                        'allowed' => $allowed,
                        'order' => 4,
                        'label' => 'Activar/Desactivar categoria'
                    ]
                ]
            ]
        ];
    }

    private function events_slugs($allowed)
    {
        return [

            'index' => [
                'allowed' => $allowed,
                'order' => 1,
                'label' => 'Listar Eventos',
                'inner' => [
                    'data' => ['allowed' => $allowed]
                ]
            ],
            'create' => [
                'allowed' => $allowed,
                'order' => 2,
                'label' => 'Crear evento',
                'inner' => [
                    'store' => ['allowed' => $allowed],
                    'verify' => ['allowed' => $allowed]
                ]
            ],
            'edit' => [
                'allowed' => $allowed,
                'order' => 3,
                'label' => 'Editar evento',
                'inner' => [
                    'update' => ['allowed' => $allowed],
                    'verify' => ['allowed' => $allowed]
                ]
            ],
            'enable_disable' => [
                'allowed' => $allowed,
                'order' => 4,
                'label' => 'Activar/Desactivar evento'
            ]
        ];
    }

    /** END JSON tree **/

    /** Do not touch the following methods *
     * @param $name
     * @param $label
     * @param $allowed
     * @param $showToUsers
     * @param null $parents
     * @param null $role
     * @param null $specific
     * @return mixed
     */
    private function _makePermission($name, $label, $showToUsers, $allowed, $parents = null, $role = null, $specific = null)
    {
        $model = config('acl.permission');
        $permissionModel = new $model;

        $permissionMethod = $name . "_slugs";
        $permissionsToAdd = $this->$permissionMethod($allowed);

        if ($specific && is_array($specific)) {
            foreach ($permissionsToAdd as $key => $item) {
                if (!in_array($key, $specific)) {
                    unset($permissionsToAdd[$key]);
                }
            }
        }

        $permission = $permissionModel->create([
            'name' => $name . ($role ? '.' . $role->slug : ''),
            'label' => $label,
            'show_to_users' => $showToUsers,
            'description' => 'Permisos base para la gestión de ' . $label,
            'slug' => $permissionsToAdd,
            'inherit_id' => $parents[$name]
        ]);
        if ($role) {
            $role->permissions()->attach($permission);
        }
        return $permission->id;
    }

    /**
     * @param $allowed
     * @param null $parents
     * @param null $role
     * @return array
     */
    private function _buildPermissions($allowed, $parents = null, $role = null)
    {
        $parentPermissions = [];

        foreach (Acl::$SYSTEM_PERMISSIONS as $p) {
            $slug = $p['name'] . ($role ? '.' . $role->slug : '');
            if (!array_key_exists('show_to_users', $p)) {
                $p['show_to_users'] = 1;
            }
            $parentPermissions[$slug] = $this->_makePermission($p['name'], $p['label'], $p['show_to_users'], $allowed, $parents, $role);
        }

        return $parentPermissions;
    }

    /**
     * @param $role
     * @param $permissions
     * @param $parentPermissions
     * @throws Exception
     */
    private function _assignSpecificPermissions($role, $permissions, $parentPermissions)
    {
        foreach ($permissions as $slug => $permission) {
            $basePermission = $this->checkIndividualPermission($slug);
            if (!$basePermission) {
                throw new Exception('Specific Role is invalid');
            }
            if ($permission === '*') {
                $this->_makePermission($slug, $basePermission['label'], $basePermission['show_to_users'], true, $parentPermissions, $role);
            } elseif (is_array($permission)) {
                $this->_makePermission($slug, $basePermission['label'], $basePermission['show_to_users'], true, $parentPermissions, $role, $permission);
            } else {
                throw new Exception('Specific Roles tree is invalid');
            }
        }
    }

    /**
     * @param $slug
     * @return bool|mixed
     */
    private function checkIndividualPermission($slug)
    {
        foreach (Acl::$SYSTEM_PERMISSIONS as $p) {
            if ($p['name'] === $slug) {
                return $p;
            }
        }
        return false;
    }
}