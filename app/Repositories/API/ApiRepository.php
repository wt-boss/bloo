<?php

namespace App\Repositories\Api;


class ApiRepository
{
    /**
     * Return fail response 
     * 
     * @param mixed $message
     * @param int $code
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function failedResponse($message = null, $code = 500)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
        ], $code);
    }

    /**
     * Return success response
     * 
     * @param string $message
     * @param mixed $content
     * @param string $token
     * @param int $code
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function successResponse($message = null, $content = null, $token = null, $code = 200)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'content' => $content,
            'token' => 'Bearer ' . $token,
        ], $code);
    }
}