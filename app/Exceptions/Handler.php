<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'status' => 404,
                'message' => trans('model_not_found'),
            ], 404);
        }else if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'status' => 404,
                'message' => trans('not_found'),
            ], 404);
        }else if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'status' => 405,
                'message' => trans('wrong_method')
            ], 405);
        }else if ($exception instanceof UnauthorizedHttpException) {
            return response()->json([
                'status' => 401,
                'message' => trans('unauthorized')
            ], 401);
        }

        return parent::render($request, $exception);
    }
}
