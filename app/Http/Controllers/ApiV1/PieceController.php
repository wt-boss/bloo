<?php

namespace App\Http\Controllers\ApiV1;

use Exception;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Repositories\Api\ApiRepository;
use App\Http\Requests\UploadPieceRequest;

class PieceController extends Controller
{
    /**
     * Display user's piece
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function index(ApiRepository $apiRepository)
    {
        try {
            $pieces = JWTAuth::user()->pieces;
            if(!($pieces->count() > 0)){
                return $apiRepository->jsonResponse(trans('no_piece'), Response::HTTP_OK);
            }
            
            $front_url = env('APP_URL') . '/files/avatar/' . $pieces->last()->front;
            $rear_url = env('APP_URL') . '/files/avatar/' . $pieces->last()->rear;
            $urls = [
                'front_url' => $front_url, 
                'rear_url' => $rear_url
            ];

            return $apiRepository->jsonResponse($pieces->count() . ' piece(s)', Response::HTTP_FOUND, [$urls]);

        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }

    /**
     * Upload user's piece
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * @param App\Http\Requests\UploadPieceRequest $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function store(UploadPieceRequest $request, ApiRepository $apiRepository)
    {
        try {
            $piece = JWTAuth::user()->pieces()->create($request->validated());
            $front_url = env('APP_URL') . '/files/avatar/' . $piece->front;
            $rear_url = env('APP_URL') . '/files/avatar/' . $piece->rear;
            $urls = [
                'front_url' => $front_url, 
                'rear_url' => $rear_url
            ];

            return $apiRepository->jsonResponse(trans('piece_upload_success'), Response::HTTP_CREATED, [$urls]);
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }
}
