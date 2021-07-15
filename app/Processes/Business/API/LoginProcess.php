<?php

namespace App\Processes\Business\API;

use App\Repositories\Repository\Admin\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\LoginController;
use App\Processes\Business\EventsProcess;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;

/**
 * Class LoginProcess
 * @package App\Processes\Business\API
 */
class LoginProcess
{
    use AuthenticatesUsers;

    /**
     * @var LoginController
     */
    protected $loginController;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var EventsProcess
     */
    protected $eventsProcess;

    /**
     * Constructor to LoginProcess.
     *
     * @param LoginController $loginController
     * @param UserRepository $userRepository
     * @param EventsProcess $eventsProcess
     */
    public function __construct(
        LoginController $loginController,
        UserRepository $userRepository,
        EventsProcess $eventsProcess
    ) {
        $this->loginController = $loginController;
        $this->userRepository = $userRepository;
        $this->eventsProcess = $eventsProcess;
    }

    /**
     * Verify in database login user.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function login(Request $request)
    {
        $this->loginController->validateLogin($request);
        $data = $request->all();
        $user = $this->loginController->checkUserVerify($request);
        if (Hash::check($data['password'], $user->password)) {
            if ($user != null) {
                if ($user->enabled == 0) {
                    dd(1);
                    $response = [
                        'type' => 'error',
                        'text' => trans('auth.disabled_user')
                    ];
                } else {
                    if ($user->hasRole('client')) {
                        dd(2);
                        $response = [
                            'type' => 'success',
                            'text' => trans('auth.success'),
                            'userId' => $user->id
                        ];
                    } else {
                        dd(3);
                        $response = [
                            'type' => 'error',
                            'text' => trans('auth.disabled_role')
                        ];
                    }
                }
            } else {
                dd(4);
                $response = [
                    'type' => 'error',
                    'text' => trans('auth.disabled_user')
                ];
            }
        } else {
            dd(5);
            $response = [
                'type' => 'error',
                'text' => trans('auth.user_password_error')
            ];
        }
        return $response;
    }

    /**
     * Verify in database search this email.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function forgotPassword(Request $request)
    {
        $data = $request->all();
        $user = $this->userRepository->findBy('email', $data['email']);
        if ($user != null) {
            if ($user->enabled == 0) {
                $response = [
                    'type' => 'error',
                    'text' => trans('auth.disabled_user')
                ];
            } else {
                if ($user->hasRole('client')) {
                    // $this->eventsProcess->sendEmailForgotPassword($user);
                    $response = [
                        'type' => 'success',
                        'text' => trans('auth.email_success')
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

    /**
     * Crate in database new model.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function register(Request $request)
    {
        $data = $request->all();
        $user = $this->userRepository->findBy('email', $data['email']);
        if (!$user) {
            // Create rol user CLIENT
            $data['roles'] = 3;
            $user = $this->userRepository->createFromArray($data);
            // Send email.
            $this->eventsProcess->sendEmailRegister($user, $data['password']);
            $response = [
                'type' => 'success',
                'text' => trans('auth.create_user_success')
            ];
        } else {
            $response = [
                'type' => 'error',
                'text' => trans('auth.user_exist')
            ];
        }
        return $response;
    }
}