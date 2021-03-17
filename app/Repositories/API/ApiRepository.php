<?php

namespace App\Repositories\Api;

class ApiRepository
{
    /**
     * Return fail response 
     * 
     * @param mixed $e
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function failedResponse($e)
    {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage(),
        ]);
    }

    /**
     * Return success response
     * 
     * @param string $message
     * @param mixed $content
     * @param string $token
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function successResponse($message = null, $content = null, $token = null)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'content' => $content,
            'token' => $token,
        ]);
    }
}