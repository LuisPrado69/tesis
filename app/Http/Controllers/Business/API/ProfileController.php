<?php

namespace App\Http\Controllers\Business\API;

use App\Repositories\Repository\Admin\UserRepository;
use App\Http\Controllers\Controller;
use App\Processes\Admin\UserProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Business\Catalogs
 */
class ProfileController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserProcess
     */
    protected $userProcess;

    /**
     * Constructor to ProfileController.
     *
     * @param UserRepository $userRepository
     * @param UserProcess $userProcess
     */
    public function __construct(
        UserRepository $userRepository,
        UserProcess $userProcess
    ) {
        $this->userRepository = $userRepository;
        $this->userProcess = $userProcess;
    }

    /**
     * Show data from model.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function searchUserId(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->userRepository->find($data['userId']);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Update user information.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updateUser(Request $request)
    {
        try {
            $data = $request->all();
            $entity = $this->userProcess->update($request, $data['userId']);
            $response = [
                'type' => $entity['message']['type'],
                'text' => $entity['message']['text']
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}