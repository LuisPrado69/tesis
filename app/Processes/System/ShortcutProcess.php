<?php

namespace App\Processes\System;

use App\Repositories\Repository\System\ShortcutRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Models\System\Shortcut;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Throwable;
use Exception;

/**
 * Class ShortcutProcess
 * @package App\Processes\System
 */
class ShortcutProcess
{

    /**
     * @var ShortcutRepository
     */
    protected $shortcutRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ShortcutController constructor.
     * @param ShortcutRepository $shortcutRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        ShortcutRepository $shortcutRepository,
        UserRepository $userRepository
    ) {
        $this->shortcutRepository = $shortcutRepository;
        $this->userRepository = $userRepository;
    }

    public function process()
    {
        return 'App\Processes\Admin\ShortcutProcess';
    }

    /**
     * @return mixed
     * @throws Throwable
     */
    public function navbar()
    {
        $shortcuts = $this->shortcutRepository->findByUserId(currentUser()->id, 10);
        $response['view'] = view('layout.partial.shortcut_button', [
            'shortcuts' => $shortcuts
        ])->render();
        return $response;
    }

    /**
     * @return mixed
     * @throws Throwable
     */
    public function index()
    {
        $shortcuts = $this->shortcutRepository->findByUserId(currentUser()->id);
        $response['modal'] = view('shortcut.index', [
            'shortcuts' => $shortcuts
        ])->render();
        return $response;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        return DataTables::eloquent(Shortcut::query())
            ->setRowId('id')
            ->addColumn('bulk_action', function ($entity) {
                return "<input type='checkbox' name='table_records_check_box' class='bulk check-box-one' value='{$entity->id}' />";
            })
            ->editColumn('name', function ($entity) {
                return "<a href='" . fullUrl($entity->URL) . "' class='ajaxify' data-dismiss='modal'>{$entity->name}</a>";
            })
            ->addColumn('created_at', function ($entity) {
                Carbon::setLocale(config('app.locale'));
                return $entity->updated_at->diffForHumans();
            })
            ->rawColumns(['bulk_action', 'name', 'created_at'])
            ->make(true);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {

        if ($request->all()['name'] == '') {
            throw new Exception(trans('app.messages.exceptions.unexpected'), 1000);
        }
        $entity = $this->shortcutRepository->create($request->all());
        if (!$entity) {
            throw new Exception(trans('app.messages.exceptions.unexpected'), 1000);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('shortcuts.messages.success.created')
        ];
        return $response;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $entity = $this->shortcutRepository->findById($request->id);
        $this->shortcutRepository->delete($entity);
        $response['message'] = [
            'type' => 'success',
            'text' => trans('shortcuts.messages.success.deleted')
        ];
        return $response;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function bulkDestroy(Request $request)
    {
        $entities = $this->shortcutRepository->findByIds($request->ids);
        foreach ($entities as $entity)
            $this->shortcutRepository->delete($entity);
        $response['message'] = [
            'type' => 'success',
            'text' => trans('shortcuts.messages.success.deleted_bulk')
        ];
        return $response;
    }

}