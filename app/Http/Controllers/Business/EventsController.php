<?php

namespace App\Http\Controllers\Business;

use App\Processes\Business\EventsProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class EventsController
 * @package App\Http\Controllers\Business\Catalogs
 */
class EventsController extends Controller
{

    /**
     * @var EventsProcess
     */
    protected $eventsProcess;

    /**
     * Constructor to EventsController.
     *
     * @param EventsProcess $eventsProcess
     */
    public function __construct(
        EventsProcess $eventsProcess
    ) {
        $this->eventsProcess = $eventsProcess;
    }

    /**
     * Show index view from model.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.events.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Load datatable from model.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->eventsProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e);
        }
    }

    /**
     * Load view to create new model.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['modal'] = view('business.events.create',
                $this->eventsProcess->create()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Save in database new model.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $entity = $this->eventsProcess->store($request);
            $this->eventsProcess->sendEmail($entity);
            $response = [
                'view' => view('business.events.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('events.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Load view from edit model.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['modal'] = view('business.events.update',
                $this->eventsProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Update in database model.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->eventsProcess->update($request, $id);
            $response = [
                'view' => view('business.events.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('events.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Enable or Disable this model.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function enableDisable($id)
    {
        try {
            $this->eventsProcess->status($id);
            $response['message'] = [
                'type' => 'success',
                'text' => trans('events.messages.success.updated')
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Filter if exist register in this model.
     *
     * @param Request $request
     *
     * @return false|string
     */
    public function verify(Request $request)
    {
        try {
            $response = $this->eventsProcess->checkNameExists($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return json_encode(!$response);
    }
}