<?php

namespace App\Processes\Business\API;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Exception;

/**
 * Class LoginProcess
 * @package App\Processes\Business\API
 */
class LoginProcess
{

    /**
     * @var LoginController
     */
    protected $loginController;

    /**
     * Constructor to LoginProcess.
     *
     * @param LoginController $loginController
     */
    public function __construct(
        LoginController $loginController
    ) {
        $this->loginController = $loginController;
    }

    /**
     * Verify in database new model.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function login(Request $request)
    {
        $this->loginController->validateLogin($request);
        $user = $this->loginController->checkUserStatus($request);
        if ($user != null) {
            if ($user->enabled == 0) {
                $response = [
                    'type' => 'error',
                    'text' => trans('auth.disabled_user')
                ];
            } else {
                if ($user->hasRole('client')) {
                    $response = [
                        'type' => 'success',
                        'text' => trans('auth.success')
                    ];
                } else {
                    $response = [
                        'type' => 'error',
                        'text' => trans('auth.disabled_role')
                    ];
                }
            }
        } else {
            $response = [
                'type' => 'error',
                'text' => trans('auth.disabled_user')
            ];
        }
        return $response;
    }
}