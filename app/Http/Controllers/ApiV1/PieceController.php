<?php

namespace App\Http\Controllers\ApiV1;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Repositories\Api\ApiRepository;
use App\Http\Requests\UploadPieceRequest;
use Illuminate\Support\Facades\Storage;

class PieceController extends Controller
{
    protected $token;

    public function __construct(Request $request)
    {
        $this->token = $request->header('Authorization');
    }
    /**
     * Upload user's piece
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * @param App\Http\Requests\UploadPieceRequest $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function uploadPiece(ApiRepository $apiRepository, UploadPieceRequest $request)
    {
        try {
            $piece = JWTAuth::user()->pieces()->create($request->validated());
            $front_url = env('APP_URL') . '/files/avatar/' . $piece->front;
            $rear_url = env('APP_URL') . '/files/avatar/' . $piece->rear;
            $urls = [
                'front_url' => $front_url, 
                'rear_url' => $rear_url
            ];

            return $apiRepository->successResponse(trans('piece_upload_success'), $urls, null, 201);

        } catch (JWTException $e) {
            return $apiRepository->failedResponse(trans('general_error'));
        }
    }

    /**
     * Display user's piece
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getPiece(ApiRepository $apiRepository)
    {
        try {
            $pieces = JWTAuth::user()->pieces;
            $message = ($pieces) ? $pieces->count() . ' piece(s)' : trans('no_piece');
            
            $front_url = env('APP_URL') . '/files/avatar/' . $pieces->last()->front;
            $rear_url = env('APP_URL') . '/files/avatar/' . $pieces->last()->rear;
            $urls = [
                'front_url' => $front_url, 
                'rear_url' => $rear_url
            ];

            return $apiRepository->successResponse($message, $urls, null, 200);

        } catch (JWTException $e) {
            return $apiRepository->failedResponse(trans('general_error'));
        }
    }
}
