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
        $user = JWTAuth::user();

        try {
            $piece = $user->pieces()->create($request->validated());
            $front_url = env('APP_URL') . '/files/avatar/' . $piece->front;
            $rear_url = env('APP_URL') . '/files/avatar/' . $piece->rear;
            // $urls = [
            //     'front_url' => $front_url, 
            //     'rear_url' => $rear_url
            // ];

            return response()->json([
                'status' => true,
                'message' => 'Piece has been successfully uploaded',
                'front_url' => $front_url,
                'rear_url' => $rear_url,
                // 'urls' => json_encode($urls),
                'token' => $this->token,
            ]);

        } catch (Exception $e) {
            return $apiRepository->failResponse($e);
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
            $piece = JWTAuth::user()->pieces->last();
            $message = ($piece) ? $piece->count() . ' piece(s)' : 'No piece has been uploaded';
            
            $front_url = env('APP_URL') . '/files/avatar/' . $piece->front;
            $rear_url = env('APP_URL') . '/files/avatar/' . $piece->rear;

            return response()->json([
                'status' => true,
                'message' => $message,
                'front_url' => $front_url,
                'rear_url' => $rear_url,
                'token' => $this->token,
            ]);
        } catch (Exception $e) {
            return $apiRepository->failResponse($e);
        }
    }

    /**
     * Update user's piece
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function updatePiece(ApiRepository $apiRepository)
    {
        $user = JWTAuth::user();

        if($user->pieces){
            return response()->json([
                'status' => true,
                'message' => 'No piece found',
                'token' => $this->token,
            ]);
        }
        try {
            //code...
        } catch (\Throwable $th) {
            $apiRepository->failResponse($th);
        }
    }
}
