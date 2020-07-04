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
    )
    {
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
        $entity = $this->loginController->login($request);
        dd($entity);
        if (!$entity) {
            throw new Exception(trans('events.messages.errors.create'), 1000);
        }
        return $entity;
    }
}