<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Processes\Admin\UserProcess;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{

    /**
     * @var UserProcess
     */
    protected $userProcess;

    public function __construct(
        UserProcess $userProcess
    ) {
        $this->userProcess = $userProcess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $response['view'] = view('admin.user.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Process datatables ajax response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        try {
            return $this->userProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $response = $this->userProcess->create();
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
            $response = $this->userProcess->store($request);
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
            $response = $this->userProcess->show($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $response = $this->userProcess->edit($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $response = $this->userProcess->update($request, $id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $response = $this->userProcess->destroy($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param Request $request
     *
     * @return String json
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $response = $this->userProcess->bulkDestroy($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Change status to the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        try {
            $response = $this->userProcess->status($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Change status for the specific resources from storage.
     *
     * @param Request $request
     *
     * @return String json
     */
    public function bulkStatus(Request $request)
    {
        try {
            $response = $this->userProcess->bulkStatus($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Show the form for change the password.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword($id)
    {
        try {
            $response = $this->userProcess->changePassword($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Update password
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        try {
            $response = $this->userProcess->updatePassword($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Check if document exists
     *
     * @param Request $request
     * @return string
     */
    public function checkDocumentExists(Request $request)
    {
        $result = $this->userProcess->checkDocumentExists($request);
        return json_encode(!$result);
    }



    /**
     * Check if username exists
     *
     * @param Request $request
     * @return string
     */
    public function checkUsernameExists(Request $request)
    {
        $result = $this->userProcess->checkUsernameExists($request);
        return json_encode(!$result);
    }

    /**
     * Check if email exists
     *
     * @param Request $request
     * @return string
     */
    public function checkEmailExists(Request $request)
    {
        $result = $this->userProcess->checkEmailExists($request);
        return json_encode(!$result);
    }
}
