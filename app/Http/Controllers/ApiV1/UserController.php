<?php

namespace App\Http\Controllers\ApiV1;

use Exception;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Repositories\Api\ApiRepository;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display user's details
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function me(ApiRepository $apiRepository) {
        try {
            $user = JWTAuth::user();
            $user->pieces->isNotEmpty();
            $operations = $user->operations;
            return $apiRepository->jsonResponse(null, Response::HTTP_OK, $user, null, null);
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
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
            return $apiRepository->jsonResponse(trans('update_success'), Response::HTTP_OK, $user);
        }catch(Exception $e){
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }
}
