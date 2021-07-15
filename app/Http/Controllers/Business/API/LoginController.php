<?php

namespace App\Http\Controllers\Business\API;

use App\Processes\Business\API\LoginProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class LoginController
 * @package App\Http\Controllers\Business\Catalogs
 */
class LoginController extends Controller
{
    /**
     * @var LoginProcess
     */
    protected $loginProcess;

    /**
     * Constructor to LoginController.
     *
     * @param LoginProcess $loginProcess
     */
    public function __construct(
        LoginProcess $loginProcess
    ) {
        $this->loginProcess = $loginProcess;
    }

    /**
     * Verify in database user login.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $login = $this->loginProcess->login($request);
            $response = [
                'type' => $login['type'],
                'text' => $login['text'],
                'userId' => $login['userId'] ? $login['userId'] : null
            ];
        } catch (Throwable $e) {
            $response = [
                'type' => 'error',
                'text' => trans('auth.user_password_error'),
                'userId' => null
            ];
        }
        return response()->json($response);
    }

    /**
     * Verify in database email.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        try {
            $login = $this->loginProcess->forgotPassword($request);
            $response = [
                'type' => $login['type'],
                'text' => $login['text']
            ];
        } catch (Throwable $e) {
            $response = [
                'type' => 'error',
                'text' => trans('auth.email_not_found')
            ];
        }
        return response()->json($response);
    }

    /**
     * Create in database new model.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $login = $this->loginProcess->register($request);
            $response = [
                'type' => $login['type'],
                'text' => $login['text']
            ];
        } catch (Throwable $e) {
            $response = [
                'type' => 'error',
                'text' => trans('auth.user_password_error')
            ];
        }
        return response()->json($response);
    }
}