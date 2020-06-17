<?php

namespace App\Http\Controllers\System;

use App\Processes\System\ShortcutProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class ShortcutController
 * @package App\Http\Controllers\System
 */
class ShortcutController extends Controller
{

    /**
     * @var ShortcutProcess
     */
    protected $shortcutProcess;

    /**
     * ShortcutController constructor.
     * @param ShortcutProcess $shortcutProcess
     */
    public function __construct(
        ShortcutProcess $shortcutProcess
    ) {
        $this->shortcutProcess = $shortcutProcess;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function widget(Request $request)
    {
        try {
            $response['view'] = view('layout.partial.shortcut_widget',
                [
                    'URL' => $request->all()['URL'],
                    'widget_id' => $request->all()['widget_id'],
                    'default_name' => $request->all()['default_name']
                ]
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Refresh shortcuts menu from navbar
     *
     * @return \Illuminate\Http\Response
     */
    public function navbar()
    {
        try {
            $response = $this->shortcutProcess->navbar();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $response = $this->shortcutProcess->index();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Process datatable ajax response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        try {
            return $this->shortcutProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $response = $this->shortcutProcess->store($request);
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
            $response = $this->shortcutProcess->destroy($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param Request $request
     * @return String json
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $response = $this->shortcutProcess->bulkDestroy($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
