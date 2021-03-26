<?php

namespace App\Http\Controllers\ApiV1;

use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\Api\ApiRepository;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Store new User resource
     *
     * @param Illuminate\Http\Request $request
     * @param App\Repositories\Api\ApiRepository $apiRepository
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function register(StoreUserRequest $request, ApiRepository $apiRepository)
    {
        try {
            // Create user by validated rules
            $user = new User($request->validated());
            $user->role = 1;
            $user->active = 1;
            $user->save();
            // Generate token from the created user
            $token = JWTAuth::fromUser($user);

            return $apiRepository->jsonResponse(trans('new_account'), Response::HTTP_CREATED, $user, $token);
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @param App\Repositories\Api\ApiRepository $apiRepository
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, ApiRepository $apiRepository)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $apiRepository->jsonResponse($validator->errors()->first(), Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $user = User::where('email', $request->email)->first();

        if($user){
            $password = Hash::check($request->password, $user->password);
            if(!$password){
                return $apiRepository->jsonResponse(trans('credentials_not_found'));
            }else if ($user->active === 0) {
                return $apiRepository->jsonResponse(trans('disabled_account'));
            }

            $token = JWTAuth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'active' => 1,
            ]);

            return $apiRepository->jsonResponse(trans('auth_success'), Response::HTTP_OK, null, $token);
        }
        return $apiRepository->jsonResponse(trans('user_not_found'), Response::HTTP_OK);
    }

    /**
     * Refresh the authenticated user's token
     *
     * @param App\Repositories\Api\ApiRepository $apiRepository
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(ApiRepository $apiRepository)
    {
        try{
            $new_token = JWTAuth::parseToken()->refresh(true, true);
            $expireAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'.Auth::id() , true , $expireAt);
            return $apiRepository->jsonResponse(trans('refreshed_token'), Response::HTTP_FOUND, null, $new_token);
        }catch(Exception $e){
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }

    /**
     * Log the authenticated user out
     *
     * @param  \Illuminate\Http\Request $request
     * @param App\Repositories\Api\ApiRepository $apiRepository
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request, ApiRepository $apiRepository)
    {
        $token = $request->header('Authorization');

        try {
            JWTAuth::invalidate($token);

            return $apiRepository->jsonResponse(trans('logout_success'), Response::HTTP_OK);

        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }
}
