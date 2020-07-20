<?php

namespace App\Http\Controllers\Business\API;

use App\Processes\Business\API\CategoryProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Business\Catalogs
 */
class CategoryController extends Controller
{

    /**
     * @var CategoryProcess
     */
    protected $categoryProcess;

    /**
     * Constructor to CategoryController.
     *
     * @param CategoryProcess $categoryProcess
     */
    public function __construct(
        CategoryProcess $categoryProcess
    ) {
        $this->categoryProcess = $categoryProcess;
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
            $response = $this->categoryProcess->searchUserId($request);
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
            $entity = $this->categoryProcess->updateUserId($request);
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