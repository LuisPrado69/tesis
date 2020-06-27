<?php

namespace App\Http\Controllers\Business\Catalogs;

use App\Processes\Business\Catalogs\LocationProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class LocationController
 * @package App\Http\Controllers\Business\Catalogs
 */
class LocationController extends Controller
{

    /**
     * @var LocationProcess
     */
    protected $locationProcess;

    /**
     * Constructor to LocationController.
     *
     * @param LocationProcess $locationProcess
     */
    public function __construct(
        LocationProcess $locationProcess
    ) {
        $this->locationProcess = $locationProcess;
    }

    /**
     * Show index view from model.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.catalogs.location.index')->render();
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
            return $this->locationProcess->data();
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
            $response['modal'] = view('business.catalogs.location.create')->render();
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
            $this->locationProcess->store($request);
            $response = [
                'view' => view('business.catalogs.location.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('location.messages.success.created')
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
            $response['modal'] = view('business.catalogs.location.update',
                $this->locationProcess->edit($id)
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
            $this->locationProcess->update($request, $id);
            $response = [
                'view' => view('business.catalogs.location.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('location.messages.success.updated')
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
            $this->locationProcess->status($id);
            $response['message'] = [
                'type' => 'success',
                'text' => trans('location.messages.success.updated')
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
            $response = $this->locationProcess->checkNameExists($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return json_encode(!$response);
    }
}