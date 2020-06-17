<?php

namespace App\Http\Controllers\System;

use App\Processes\System\NotificationProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class NotificationController
 * @package App\Http\Controllers\System
 */
class NotificationController extends Controller
{

    /**
     * @var NotificationProcess
     */
    protected $notificationProcess;


    /**
     * NotificationController constructor.
     * @param NotificationProcess $notificationProcess
     */
    public function __construct(
        NotificationProcess $notificationProcess
    ) {
        $this->notificationProcess = $notificationProcess;
    }

    /**
     * Display a view to notifications
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        try {
            $response = $this->notificationProcess->index($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $response = $this->notificationProcess->store($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $response = $this->notificationProcess->show($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $response = $this->notificationProcess->destroy($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchUser(Request $request)
    {
        try {
            $response = $this->notificationProcess->searchUser($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
            $response['data'] = [];
        }
        return response()->json($response);
    }
}
