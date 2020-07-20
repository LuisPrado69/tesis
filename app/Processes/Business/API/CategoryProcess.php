<?php

namespace App\Processes\Business\API;

use App\Repositories\Repository\Business\Catalogs\CategoryRepository;
use App\Repositories\Repository\Business\CategoryUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CategoryProcess
 * @package App\Processes\Business\API
 */
class CategoryProcess
{

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var CategoryUserRepository
     */
    protected $categoryUserRepository;

    /**
     * Constructor to CategoryController.
     *
     * @param CategoryRepository $categoryRepository
     * @param CategoryUserRepository $categoryUserRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryUserRepository $categoryUserRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->categoryUserRepository = $categoryUserRepository;
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
        $data = $request->all();
        $userCategories = $this->categoryRepository->searchUserId($data['userId']);
        $categories = $this->categoryRepository->all();
        if (count($userCategories)) {
            $response = $categories->map(function ($category) use ($userCategories) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'available' => self::verifyCategory($userCategories, $category->id)
                ];
            });
        } else {
            $response = $categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'available' => false
                ];
            });
        }
        return $response;
    }

    /**
     * Show index view from model.
     *
     * @param Request $request
     *
     * @return array[]
     */
    public function updateUserId(Request $request)
    {
        $data = $request->all();
        $userCategories = $this->categoryUserRepository->searchUserIdField($data['userId'], $data['name']);
        if ($userCategories) {
            $this->categoryUserRepository->delete($userCategories->id);
        } else {
            $category = $this->categoryRepository->findBy('name', $data['name']);
            $dataCategoryUser = [
                'category_id' => $category->id,
                'user_id' => $data['userId']
            ];
            $this->categoryUserRepository->createFromArray($dataCategoryUser);
        }
        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('category.messages.success.updated')
            ]
        ];
        return $response;
    }

    /**
     * @param $userCategories
     * @param $categoryId
     *
     * @return bool
     */
    private function verifyCategory($userCategories, $categoryId)
    {
        $validate = false;
        foreach ($userCategories as $userCategory) {
            if ($userCategory->id === $categoryId) {
                $validate = true;
                break;
            }
        }
        return $validate;
    }
}