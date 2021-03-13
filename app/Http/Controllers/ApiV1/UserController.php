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
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function me(ApiRepository $apiRepository)
    {
        try {
            return $apiRepository->successReponse('', JWTAuth::user(), $this->token);
        } catch (Exception $e) {
            return $apiRepository->failResponse($e);
        }
    }

    /**
     * Update user's details
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
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

            $message = 'Changes have been successfully updated';

            return $apiRepository->successReponse($message, $user, $this->token);
        }catch(Exception $e){
            return $apiRepository->failResponse($e);
        }
        
    }
}