<?php

namespace App\Http\Controllers\Business\API;

use App\Repositories\Repository\Business\Catalogs\CategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Business\Catalogs
 */
class CategoryController extends Controller
{

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Constructor to CategoryController.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show index view from model.
     *
     * @return JsonResponse
     */
    public function all()
    {
        try {
            $response = $this->categoryRepository->all();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}