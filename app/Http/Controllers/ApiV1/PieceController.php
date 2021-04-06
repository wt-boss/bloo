<?php

namespace App\Http\Controllers\ApiV1;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Repositories\Api\ApiRepository;
use App\Http\Requests\UploadPieceRequest;
use App\Piece;
use Illuminate\Http\Resources\Json\Resource;

class PieceController extends Controller
{
    public $api;
    public function __construct(ApiRepository $apiRepository)
    {
        $this->api = $apiRepository;
    }
    /**
     * Display user's piece
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $pieces = JWTAuth::user()->pieces;
            $expireAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'.Auth::id() , true , $expireAt);
            if($pieces->isEmpty()){
                return $this->api->jsonResponse(false, trans('no_piece'), Response::HTTP_OK);
            }

            $pieces->last()->front = env('APP_URL') . '/files/avatar/' . $pieces->last()->front;
            $pieces->last()->rear = env('APP_URL') . '/files/avatar/' . $pieces->last()->rear;

            return $this->api->jsonResponse(true, $pieces->count() . ' piece(s)', Response::HTTP_OK, $pieces->last());

        } catch (Exception $e) {
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }

    /**
     * Upload user's piece
     *
     * @param App\Http\Requests\UploadPieceRequest $request
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function store(UploadPieceRequest $request)
    {
        try {
            $piece = JWTAuth::user()->pieces()->create($request->validated());
            $front_url = env('APP_URL') . '/files/avatar/' . $piece->front;
            $rear_url = env('APP_URL') . '/files/avatar/' . $piece->rear;
            $piece->front_url = $front_url;
            $piece->rear_url = $rear_url;

            $expireAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'.Auth::id() , true , $expireAt);

            return $this->api->jsonResponse(true, trans('piece_upload_success'), Response::HTTP_CREATED, $piece);
        } catch (Exception $e) {
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }
}
