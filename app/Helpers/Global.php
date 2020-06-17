<?php

use Illuminate\Database\Eloquent\Collection;

/**
 * Get the current logged user
 *
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
function currentUser()
{
    return auth()->user();
}

/**
 * Get the permission for the role
 *
 * @param null $role
 * @return array
 */
function permissions($role = null)
{
    $result = [];

    // base permissions
    $bases = (config('acl.permission'))::whereNull('inherit_id')->where('show_to_users', '<>', '0')->get();
    foreach ($bases as $base) {
        $result[$base->id] = [
            'name' => $base->name,
            'label' => (null != $base->label ? $base->label : $base->name),
            'actions' => $base->slug
        ];
    }

    // rewrite role permissions
    if (null != $role) {
        $permissions = (config('acl.permission'))::join('permission_role', 'permission_role.permission_id', 'permissions.id')
            ->where('permission_role.role_id', $role->id)
            ->where('show_to_users', '<>', '0')
            ->get();

        foreach ($permissions as $permission) {
            if (null == $permission->inherit_id) {
                $result[$permission->permission_id] = [
                    'name' => $permission->name,
                    'label' => (null != $permission->label ? $permission->label : $permission->name),
                    'actions' => $permission->slug
                ];
            } else {
                foreach ($permission->slug as $key => $action) {
                    $result[$permission->inherit_id]['actions'][$key] = $action;
                }
            }
        }
    }

    return $result;
}

function allPermissions($role = null)
{
    $result = [];

    // base permissions
    $bases = (config('acl.permission'))::whereNull('inherit_id')->get();
    foreach ($bases as $base) {
        $result[$base->id] = [
            'name' => $base->name,
            'label' => (null != $base->label ? $base->label : $base->name),
            'actions' => $base->slug
        ];
    }

    // rewrite role permissions
    if (null != $role) {
        $permissions = (config('acl.permission'))::join('permission_role', 'permission_role.permission_id', 'permissions.id')
            ->where('permission_role.role_id', $role->id)
            ->get();

        foreach ($permissions as $permission) {
            if (null == $permission->inherit_id) {
                $result[$permission->permission_id] = [
                    'name' => $permission->name,
                    'label' => (null != $permission->label ? $permission->label : $permission->name),
                    'actions' => $permission->slug
                ];
            } else {
                foreach ($permission->slug as $key => $action) {
                    $result[$permission->inherit_id]['actions'][$key] = $action;
                }
            }
        }
    }

    return $result;
}

/**
 * Order permission.
 *
 * @param array $data
 *
 * @return Collection
 */
function order_permissions(array $data)
{
    $data_permissions = collect($data);
    $result = $data_permissions->sortBy('is_primary');
    return $result->sortBy('order');
}

/**
 * @param $date
 * @param $format
 * @return string
 */
function formatDate($date, $format)
{
    return \Carbon\Carbon::parse($date)->format($format);
}

/**
 * @param string $filename
 * @param string $delimiter
 * @return array|bool
 */
function csv_to_array($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename)) {
        return false;
    }

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            if (!array_filter($row)) {
                break;
            }

            if (!$header) {
                $header = $row;
                foreach ($header as &$h) {
                    $h = trim($h);
                }
            } else {
                $new_row = array_combine($header, $row);
                if (!is_bool($new_row)) {
                    $data[] = $new_row;
                }
            }

        }
        fclose($handle);
    }
    return $data;
}

/**
 * @param $value
 * @param $total
 * @return float|int
 */
function percent($value, $total)
{
    if ($total == 0) {
        return 0;
    }

    return round($value * 100 / $total, 2);
}

/**
 * @param Throwable $e
 * @param bool $success
 * @return mixed
 */
function defaultCatchHandler(Throwable $e, $success = true)
{
    $code = $e->getCode();

    switch ($code) {
        case 2000:
            $type = 'warning';
            break;
        default:
            $type = 'error';
    }

    $response['message'] = [
        'type' => $type,
        'text' => $code == 1000 || $code == 2000 ? $e->getMessage() : trans('app.messages.exceptions.unexpected')
    ];

    if ($success == false) {
        $response['success'] = false;
    }

    if (displayException($code)) {
        $response['exception']['message'] = $e->getMessage();
    }

    if(!($e instanceof \Illuminate\Session\TokenMismatchException) && $code != 2000) {
        Illuminate\Support\Facades\Log::error($e->getMessage());
        Illuminate\Support\Facades\Log::error($e->getTraceAsString());
    }

    return $response;
}

/**
 * @param null $code
 * @return bool
 */
function displayException($code = null)
{
    return $code !== 1000 && currentUser()->hasRole(config('app.display_exception_to_roles'));
}

/**
 * @param $url
 * @return string
 */
function fullUrl($url)
{
    return url('/') . $url;
}

/**
 * @param Throwable $e
 * @return string
 */
function datatableEmptyResponse(Throwable $e)
{
    \Illuminate\Support\Facades\Log::error($e->getMessage());
    \Illuminate\Support\Facades\Log::error($e->getTraceAsString());

    return json_encode(['draw' => 0, 'recordsTotal' => 0, 'recordsFiltered' => 0, 'data' => []]);
}