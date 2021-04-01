<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

trait ExceptionTrait
{
    /**
     * Handling api Http exceptions
     * 
     * @param Exception $exception
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiException(Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException){
            return $this->apiExceptionResponse(Response::HTTP_NOT_FOUND, trans('model_not_found'));
        }
        else if ($exception instanceof NotFoundHttpException){
            return $this->apiExceptionResponse(Response::HTTP_NOT_FOUND, trans('not_found'));
        }
        else if ($exception instanceof MethodNotAllowedHttpException){
            return $this->apiExceptionResponse(Response::HTTP_METHOD_NOT_ALLOWED, trans('wrong_method'));
        }
        else if ($exception instanceof UnauthorizedHttpException){
            return $this->apiExceptionResponse(Response::HTTP_UNAUTHORIZED, trans('unauthorized'));
        }
        else{
            return $this->apiExceptionResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        } 
    }
    
    /**
     * Return status and message error
     * 
     * @param int $code
     * @param string $message
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiExceptionResponse($code, $message)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $code);
    }
}