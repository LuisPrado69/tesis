<?php

namespace App\Processes\Business\Catalogs;

use App\Repositories\Repository\Business\Catalogs\CategoryRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Models\System\Setting;
use Illuminate\Http\Request;
use Exception;

/**
 * Class CategoryProcess
 * @package App\Processes\Business\Catalogs
 */
class CategoryProcess
{

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Constructor to CategoryProcess.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Load information to model.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];
        if ($user->can('edit.category.catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.category.catalogs',
                'tooltip' => trans('category.labels.edit')
            ];
        }
        $query = $this->categoryRepository->all();
        return DataTables::of($query)
            ->setRowId('id')
            ->addColumn('enabled', function ($entity) use ($user) {
                $checked = $entity->status ? 'checked' : '';
                if ($user->can('enable_disable.category.catalogs')) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                }
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions', 'enabled'])
            ->make(true);
    }

    /**
     * Save in database new model.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $entity = $this->categoryRepository->createFromArray($data);
        if (!$entity) {
            throw new Exception(trans('category.messages.errors.create'), 1000);
        }
        return $entity;
    }

    /**
     * Return view to edit model.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->categoryRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('category.messages.errors.create'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Update view to edit model.
     *
     * @param Request $request
     * @param int $id
     *
     * @return Setting|mixed|null
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $entity = $this->categoryRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('category.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->categoryRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('category.messages.errors.update'), 1000);
        }
        return $entity;
    }

    /**
     * Enable/ Disable this model.
     *
     * @param $id
     *
     * @return mixed
     * @throws Exception
     */
    public function status($id)
    {
        $entity = $this->categoryRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('category.messages.exceptions.not_found'), 1000);
        }
        if (!$this->categoryRepository->changeStatus($entity)) {
            throw new Exception(trans('category.messages.errors.update'), 1000);
        }
        return $entity;
    }

    /**
     * Check if name exists.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function checkNameExists(Request $request)
    {
        if (isset($request->id)) {
            $result = $this->categoryRepository->exists(['name' => $request->name], $request->id);
        } else {
            $result = $this->categoryRepository->exists(['name' => $request->name]);
        }
        return $result;
    }
}