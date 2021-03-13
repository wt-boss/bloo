<?php

namespace App\Repositories\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Piece;

class ApiRepository
{
    /**
     * Return fail response 
     * 
     * @param mixed Exception $e
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function failResponse(Exception $e)
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
    public function successReponse($message = null, $content, $token)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'content' => $content,
            'token' => $token,
        ]);
    }

    /**
     * Save image publicly
     * 
     * @param string $image
     * 
     */
    public function storePiece($image)
    {
        $file = $_FILES[$image];
        $user = JWTAuth::user();

        $filename = Str::random(8) . '_' . $user->id . $file['name'];
        $upload = 'uploads/' . $filename;

        move_uploaded_file($file['tmp_name'], $upload);
        $url = Storage::url($upload);

        $piece = new Piece;
        $piece->user_id = $user->id;
        $piece->$image = $upload;

        return $url;
    }
}