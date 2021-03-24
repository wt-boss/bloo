<?php

namespace App\Repositories\Api;

class ApiRepository
{
    /**
     * Return success response
     * 
     * @param string $message
     * @param mixed $content
     * @param string $token
     * @param int $code
     * @param int $extra
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function jsonResponse($message = null, $code = 500, $content = null, $token = null, $extra = null)
    {
        $collection = collect();
        return response()->json([
            'status' => $code,
            'message' => $message,
            'content' => $content,
            'token' => ($token) ? 'Bearer ' . $token : null,
            'extra' => $extra
        ], $code);
    }
}