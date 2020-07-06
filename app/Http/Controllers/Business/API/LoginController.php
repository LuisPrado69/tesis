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
     * Verify in database new model.
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