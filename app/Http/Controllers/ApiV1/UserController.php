<?php

namespace App\Http\Controllers\ApiV1;

use App\Piece;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Api\ApiRepository;

class UserController extends Controller
{
    protected $token, $user;

    public function __construct(Request $request)
    {
        $this->token = $request->header('Authorization');
    }
    /**
     * Display user's details
     * @return Illuminate\Http\JsonResponse
     */
    public function me(ApiRepository $apiRepository)
        try {

            return $apiRepository->successResponse(null, JWTAuth::user(), $this->token);

        } catch (Exception $e) {
            return $apiRepository->failedResponse($e);
        }
    }

    /**
     * Update user's details
     *
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * @param App\Http\Requests\UpdateUserRequest $request
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, ApiRepository $apiRepository)
    {
        $user = JWTAuth::user();
        try{
            $data = $request->validated();
            $user->save($data);

            $message = trans('update_success');

            return $apiRepository->successResponse($message, $user, $this->token);

        }catch(Exception $e){
            return $apiRepository->failedResponse($e);
        }

    }
}
