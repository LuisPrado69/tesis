<?php

namespace App\Http\Controllers\Business\API;

use App\Processes\Business\API\CategoryProcess;
use App\Processes\Business\API\EventsProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Business\Catalogs
 */
class EventsController extends Controller
{

    /**
     * @var EventsProcess
     */
    protected $eventsProcess;

    /**
     * Constructor to CategoryController.
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
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function searchUserId(Request $request)
    {
        try {
            $response = $this->eventsProcess->searchUserId($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Update data from this model.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updateUserId(Request $request)
    {
        try {
            Log::info("SIIII");
            $entity = $this->eventsProcess->updateUserId($request);
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