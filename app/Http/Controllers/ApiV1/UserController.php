<?php

namespace App\Http\Controllers\ApiV1;

use App\User;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\Api\ApiRepository;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public $api;
    public function __construct(ApiRepository $apiRepository)
    {
        $this->api = $apiRepository;
    }

    /**
     * Store new User resource
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function register(StoreUserRequest $request)
    {
        try {
            // Create user by validated rules
            $user = new User($request->validated());
            $user->role = 1;
            $user->active = 1;
            $user->save();
            // Generate token from the created user
            $token = JWTAuth::fromUser($user);

            return $this->api->jsonResponse(true, trans('new_account'), Response::HTTP_CREATED, $user, $token);
        } catch (Exception $e) {
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }
    
    /**
     * Display user's details
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function me() {
        try {
            $user = JWTAuth::user();
            $user->pieces->isNotEmpty();
            $user->operations;

            $expireAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'.Auth::id(), true, $expireAt);
            return $this->api->jsonResponse(true, null, Response::HTTP_OK, $user);
        } catch (Exception $e) {
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }

    /**
     * Update user's details
     * 
     * @param App\Http\Requests\UpdateUserRequest $request
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request)
    {
        try{
            $user = JWTAuth::user();
            $data = $request->validated();
            $user->update($data);
            $expireAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'.Auth::id() , true , $expireAt);
            return $this->api->jsonResponse(true, trans('update_success'), Response::HTTP_OK, $user);
        }catch(Exception $e){
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }
}
