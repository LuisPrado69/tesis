<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* App */
Auth::routes();


Route::get('/unauthorized', 'AppController@unauthorized')->name('unauthorized.app');
Route::get('/', 'AppController@index')->name('index.app');

Route::get('/dashboard', 'AppController@dashboard')->name('dashboard.app');

// email
Route::get('/confirmed_email', 'AppController@confirmedEmail')->name('confirmed_email');

/* ---------------- */
/* Global Functions */
/* ---------------- */

Route::group([
    'middleware' => ['auth']
],
    function () {
        Route::get('/configuration/checkuniquefield', 'System\UtilsController@checkUniqueField')->name('checkuniquefield');
    }
);

/* Profile */
Route::group([
    'prefix' => 'profile',
    'middleware' => ['auth']
],
    function () {

    Route::get('/', 'ProfileController@index')->name('index.profile');

    Route::get('/edit', 'ProfileController@edit')->name('edit.profile');
    Route::put('/update', 'ProfileController@update')->name('update.edit.profile');
    Route::put('/check/email', 'ProfileController@checkEmail')->name('email.check.profile');

    Route::get('/password', 'ProfileController@changePassword')->name('change.password.profile');
    Route::post('/password', 'ProfileController@updatePassword')->name('update.password.profile');

});

/* Notification */
Route::group([
    'prefix' => 'notification',
    'middleware' => ['auth']
],
    function () {

        Route::get('/notification/inbox/{id?}', 'System\NotificationController@index')->name('index.notification');
        Route::get('/notification/show/{id}', 'System\NotificationController@show')->name('show.notification');
        Route::post('/notification/send', 'System\NotificationController@store')->name('send.notification');
        Route::get('/notification/searchUser', 'System\NotificationController@searchUser')->name('search_user.notification');
        Route::delete('/notification/destroy/{id}', 'System\NotificationController@destroy')->name('destroy.notification');

    }
);

/* Shortcut */
Route::group([
    'prefix' => 'shortcut',
    'middleware' => ['auth']
],
    function () {
        Route::get('/shortcut/widget', 'System\ShortcutController@widget')->name('widget.shortcut');
        Route::get('/shortcut/navbar', 'System\ShortcutController@navbar')->name('navbar.shortcut');
        Route::get('/shortcut/data', 'System\ShortcutController@data')->name('data.index.shortcut');
        Route::get('/shortcut/index', 'System\ShortcutController@index')->name('index.shortcut');
        Route::post('/shortcut/store', 'System\ShortcutController@store')->name('store.shortcut');
        Route::delete('/shortcut/{id}/destroy', 'System\ShortcutController@destroy')->name('destroy.shortcut');
        Route::delete('/shortcut/bulk/destroy', 'System\ShortcutController@bulkDestroy')->name('bulk.destroy.shortcut');
    }
);


/* Admin */
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'route']
],
    function () {

    // roles
    Route::get('/roles/checkname/create', 'Admin\RoleController@checkNameExists')->name('checkname.create.roles');
    Route::get('/roles/checkname/edit', 'Admin\RoleController@checkNameExists')->name('checkname.edit.roles');
    Route::get('/roles/data', 'Admin\RoleController@data')->name('data.index.roles');
    Route::delete('/roles/bulk/destroy', 'Admin\RoleController@bulkDestroy')->name('bulk.destroy.roles');
    Route::put('/roles/status/{id}', 'Admin\RoleController@status')->name('status.roles');
    Route::put('/roles/bulk/status', 'Admin\RoleController@bulkStatus')->name('bulk.status.roles');
    Route::get('/roles/permissions/{id}', 'Admin\RoleController@permissions')->name('permissions.roles');
    Route::put('/roles/permissions/one', 'Admin\RoleController@onePermissions')->name('one.permissions.roles');
    Route::put('/roles/permissions/all', 'Admin\RoleController@allPermissions')->name('all.permissions.roles');

    Route::resource('roles', 'Admin\RoleController', [
        'parameters' => ['roles' => 'id'],
        'names' => [
            'index' => 'index.roles',
            'create' => 'create.roles',
            'store' => 'store.create.roles',
            'show' => 'show.roles',
            'edit' => 'edit.roles',
            'update' => 'update.edit.roles',
            'destroy' => 'destroy.roles'
        ]
    ]);

    // users
    Route::get('/users/data', 'Admin\UserController@data')->name('data.index.users');
    Route::get('/users/checkdocument/create', 'Admin\UserController@checkDocumentExists')->name('checkdocument.create.users');
    Route::get('/users/checkusername/create', 'Admin\UserController@checkUsernameExists')->name('checkusername.create.users');
    Route::get('/users/checkemail/create', 'Admin\UserController@checkEmailExists')->name('checkemail.create.users');
    Route::get('/users/checkdocument/update', 'Admin\UserController@checkDocumentExists')->name('checkdocument.edit.users');
    Route::get('/users/checkusername/update', 'Admin\UserController@checkUsernameExists')->name('checkusername.edit.users');
    Route::get('/users/checkemail/update', 'Admin\UserController@checkEmailExists')->name('checkemail.edit.users');
    Route::delete('/users/bulk/destroy', 'Admin\UserController@bulkDestroy')->name('bulk.destroy.users');
    Route::put('/users/status/{id}', 'Admin\UserController@status')->name('status.users');
    Route::put('/users/bulk/status', 'Admin\UserController@bulkStatus')->name('bulk.status.users');
    Route::get('/users/password/{id}', 'Admin\UserController@changePassword')->name('password.users');
    Route::put('/users/password/update', 'Admin\UserController@updatePassword')->name('update.password.users');

    Route::resource('users', 'Admin\UserController', [
        'parameters' => ['users' => 'id'],
        'names' => [
            'index' => 'index.users',
            'create' => 'create.users',
            'store' => 'store.create.users',
            'show' => 'show.users',
            'edit' => 'edit.users',
            'update' => 'update.edit.users',
            'destroy' => 'destroy.users'
        ]
    ]);


}
);


/* ------------- */
/* Configuration */
/* ------------- */

Route::group([
    'prefix' => 'config',
    'middleware' => ['auth', 'acl'],
    'is' => 'developer'
],
    function () {

        // permissions
        Route::get('/permissions/data', 'Configuration\PermissionController@data')->name('data.index.permissions.configuration');
        Route::delete('/permissions/bulk/destroy', 'Configuration\PermissionController@bulkDestroy')->name('bulk.destroy.permissions.configuration');
        Route::resource('permissions', 'Configuration\PermissionController', [
            'parameters' => ['permissions' => 'id'],
            'names' => [
                'index' => 'index.permissions.configuration',
                'create' => 'create.permissions.configuration',
                'store' => 'store.create.permissions.configuration',
                'show' => 'show.permissions.configuration',
                'edit' => 'edit.permissions.configuration',
                'update' => 'update.edit.permissions.configuration',
                'destroy' => 'destroy.permissions.configuration',
            ]
        ]);

        // roles
        Route::get('/roles/data', 'Configuration\RoleController@data')->name('data.index.roles.configuration');
        Route::put('/roles/editable/{id}', 'Configuration\RoleController@editable')->name('editable.roles.configuration');
        Route::put('/roles/permissions', 'Configuration\RoleController@permissions')->name('permissions.show.roles.configuration');
        Route::put('/roles/permissions/all', 'Configuration\RoleController@allPermissions')->name('all.permissions.show.roles.configuration');

        Route::resource('roles', 'Configuration\RoleController', [
            'parameters' => ['roles' => 'id'],
            'names' => [
                'index' => 'index.roles.configuration',
                'show' => 'show.roles.configuration',
            ]
        ]);

        // menus
        Route::get('/menus/data', 'Configuration\MenuController@data')->name('data.index.menus.configuration');
        Route::delete('/menus/bulk/destroy', 'Configuration\MenuController@bulkDestroy')->name('bulk.destroy.menus.configuration');
        Route::put('/menus/status/{id}', 'Configuration\MenuController@status')->name('status.menus.configuration');
        Route::put('/menus/bulk/status', 'Configuration\MenuController@bulkStatus')->name('bulk.status.menus.configuration');
        Route::resource('menus', 'Configuration\MenuController', [
            'parameters' => ['menus' => 'id'],
            'names' => [
                'index' => 'index.menus.configuration',
                'create' => 'create.menus.configuration',
                'store' => 'store.create.menus.configuration',
                'show' => 'show.menus.configuration',
                'edit' => 'edit.menus.configuration',
                'update' => 'update.edit.menus.configuration',
                'destroy' => 'destroy.menus.configuration',
            ]
        ]);

        // ui
        Route::get('/ui/edit', 'Configuration\UIController@edit')->name('edit.ui.configuration');
        Route::put('/ui/edit/update', 'Configuration\UIController@update')->name('update.edit.ui.configuration');

        // settings
        Route::get('/settings/index', 'Configuration\SettingController@index')->name('index.settings.configuration');
        Route::get('/settings/data', 'Configuration\SettingController@data')->name('data.index.settings.configuration');
        Route::get('/settings/edit/{id}', 'Configuration\SettingController@edit')->name('edit.settings.configuration');
        Route::put('/settings/update/{id}', 'Configuration\SettingController@update')->name('update.edit.settings.configuration');

    }
);

/* ------------- */
/* Catalogs */
/* ------------- */
Route::group([
    'prefix' => 'catalogs',
    'middleware' => ['auth', 'route']
],
    function () {
        // Nationality
        Route::get('/category/enable_disable/{id}', 'Business\Catalogs\CategoryController@enableDisable')->name('enable_disable.category.catalogs');
        Route::get('/category/data', 'Business\Catalogs\CategoryController@data')->name('data.index.category.catalogs');
        Route::get('/category/verify_create', 'Business\Catalogs\CategoryController@verify')->name('verify.create.category.catalogs');
        Route::get('/category/verify_edit', 'Business\Catalogs\CategoryController@verify')->name('verify.edit.category.catalogs');
        Route::resource('category', 'Business\Catalogs\CategoryController', [
            'parameters' => ['category' => 'id'],
            'names' => [
                'index' => 'index.category.catalogs',
                'create' => 'create.category.catalogs',
                'store' => 'store.create.category.catalogs',
                'edit' => 'edit.category.catalogs',
                'update' => 'update.edit.category.catalogs'
            ]
        ]);
    }
);

/* ------------- */
/* Events */
/* ------------- */
Route::group([
    'prefix' => 'events',
    'middleware' => ['auth', 'route']
],
    function () {
        Route::get('/enable_disable/{id}', 'Business\EventsController@enableDisable')->name('enable_disable.events');
        Route::get('/data', 'Business\EventsController@data')->name('data.index.events');
        Route::get('/verify_create', 'Business\EventsController@verify')->name('verify.create.events');
        Route::get('/verify_edit', 'Business\EventsController@verify')->name('verify.edit.events');
        Route::resource('event', 'Business\EventsController', [
            'parameters' => ['event' => 'id'],
            'names' => [
                'index' => 'index.events',
                'create' => 'create.events',
                'store' => 'store.create.events',
                'edit' => 'edit.events',
                'update' => 'update.edit.events'
            ]
        ]);
    }
);