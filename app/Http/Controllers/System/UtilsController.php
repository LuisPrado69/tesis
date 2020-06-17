<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Repositories\Library\Exceptions\ModelException;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use Illuminate\Http\Request;

/**
 * Class UtilsController
 * @package App\Http\Controllers\System
 */
class UtilsController extends Controller
{

    /**
     * @var App
     */
    private $app;

    /**
     * UtilsController constructor.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Verify if the value of a field in the BD is unique according to the specified Model.
     *
     * @param Request $request
     *
     * @return false|string
     * @throws ModelException
     * @throws Exception
     */
    public function checkUniqueField(Request $request)
    {
        if (!isset($request->model) || !isset($request->fieldName) || !isset($request->fieldValue)) {
            throw new Exception(trans('configuration.configuration.messages.errors.validate_field'));
        }

        $model = $this->app->make($request->model);

        if (!$model instanceof Model) {
            throw new ModelException($request->model);
        }
        $result = $model->where(function ($query) use ($request) {

            $query->where($request->fieldName, $request->fieldValue);

            if (isset($request->current)) {
                $query->where('id', '<>', $request->current);
            }
            if (isset($request->filter)) {
                foreach ($request->filter as $field => $value) {
                    $query->where($field, '=', $value);
                }
            }
        })->count() === 0 ? false : true;
        return json_encode(!$result);
    }
}
