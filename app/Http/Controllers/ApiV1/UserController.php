<?php

namespace App\Http\Controllers\ApiV1;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Repositories\Api\ApiRepository;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $token;

    public function __construct(Request $request)
    {
        $this->token = $request->header('Authorization');
    }
    /**
     * Display user's details
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function me(ApiRepository $apiRepository) {
        try {
            return $apiRepository->successResponse(null, JWTAuth::user());
        } catch (Exception $e) {
            return $apiRepository->failedResponse($e->getMessage());
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
        try{
            $user = JWTAuth::user();
            $data = $request->validated();
            $user->update($data);
            return $apiRepository->successResponse(trans('update_success'), $user, null, Response::HTTP_OK);
            // return ($user->wasChanged()) ? $apiRepository->successResponse(trans('update_success'), $user, null, Response::HTTP_OK) : $apiRepository->successResponse(trans('update_success'), $user, null, Response::HTTP_NOT_MODIFIED);
        }catch(Exception $e){
            return $apiRepository->failedResponse($e->getMessage());
        }
        

    }
}
