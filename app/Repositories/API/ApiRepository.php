<?php

namespace App\Repositories\Api;

use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRepository
{
    /**
     * Return success response
     * 
     * @param string $message
     * @param mixed $content
     * @param string $token
     * @param int $code
     * @param bool $extra
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function jsonResponse($message = null, $code = 500, $content = null, $token = null, $extra = null)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'content' => $content,
            'token' => ($token) ? 'Bearer ' . $token : null,
            'extra' => $extra
        ], $code);
    }

    /**
     * Return conditionnal response
     * 
     * @param collection $locale
     * @param string $message
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function conditionnalResponse($locale, $message)
    {
        return (!$locale->isEmpty()) ? $this->jsonResponse($locale->count(), Response::HTTP_OK, $locale) : $this->jsonResponse(trans($message), Response::HTTP_OK);
    }
}