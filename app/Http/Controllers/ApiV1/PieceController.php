<?php

namespace App\Http\Controllers\ApiV1;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Repositories\Api\ApiRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadPieceRequest;

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
    public function uploadPiece(UploadPieceRequest $request, ApiRepository $apiRepository)
    {
        try {
            $piece = JWTAuth::user()->pieces()->create($request->validated());
            $front_url = env('APP_URL') . '/files/avatar/' . $piece->front;
            $rear_url = env('APP_URL') . '/files/avatar/' . $piece->rear;
            $urls = [
                'front_url' => $front_url, 
                'rear_url' => $rear_url
            ];

            return $apiRepository->successResponse(trans('piece_upload_success'), $urls, null, Response::HTTP_CREATED);

        } catch (Exception $e) {
            return $apiRepository->failedResponse($e->getMessage());
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

            return $apiRepository->successResponse($message, $urls, null, Response::HTTP_FOUND);

        } catch (Exception $e) {
            return $apiRepository->failedResponse($e->getMessage());
        }
    }
}
