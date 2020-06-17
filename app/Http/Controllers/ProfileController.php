<?php

namespace App\Http\Controllers;

use App\Repositories\Repository\Admin\UserRepository;
use Illuminate\Http\Request;
use Exception;
use Throwable;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RoleController constructor.
     *
     * @param UserRepository $userRepository
     */
    function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Display the current user permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $entity = currentUser();
            if (!$entity) {
                throw new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
            }
            $user = $entity->user ? $entity->user : $entity;
            $response['view'] = view('profile.index', [
                'entity' => $entity,
                'user' => $user
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Show a view for edit user info
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit()
    {
        try {
            $entity = currentUser();
            if (!$entity) {
                throw new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
            }
            $user = $entity->user ? $entity->user : $entity;
            $response['view'] = view('profile.update', [
                'entity' => $entity,
                'user' => $user
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Update user info.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $entity = currentUser();
            if (!$entity) {
                throw new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
            }
            $data = $request->all();
            $data['enabled'] = $entity->enabled;
            $data['roles'] = $entity->roles;
            $entity = $this->userRepository->updateFromArray($data, $entity);
            if (!$entity) {
                throw new Exception(trans('users.user.messages.errors.update'), 1000);
            }
            $user = $entity->user ? $entity->user : $entity;
            $response = [
                'view' => view('profile.index', ['entity' => $entity, 'user' => $user])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('users.user.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Show the form for change password for the current user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {
        return view('profile.password');
    }

    /**
     * Update password for the current user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        try {
            $entity = currentUser();
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
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Check if email exists
     *
     * @param Request $request
     * @return string
     */
    public function checkEmail(Request $request)
    {
        $result = $this->userRepository->exists(['email' => $request->email], $request->id);
        return json_encode(!$result);
    }
}
