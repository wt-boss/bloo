<?php

namespace App\Http\Controllers\ApiV1;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\Api\ApiRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

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

            return $apiRepository->successResponse(trans('new_account'), $user, $token, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $apiRepository->failedResponse($e->getMessage());
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
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();

        if($user){
            $password = Hash::check($request->password, $user->password);
            if(!$password){
                return $apiRepository->failedResponse(trans('credentials_not_found'));
            }else if ($user->active === 0) {
                return $apiRepository->failedResponse(trans('disabled_account'));
            }
            
            $token = JWTAuth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'active' => 1,
            ]);

            return $apiRepository->successResponse(trans('auth_success'), null, $token);
        }
        return $apiRepository->failedResponse(trans('user_not_found'), Response::HTTP_NOT_FOUND);
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

            return $apiRepository->successResponse(trans('refreshed_token'), null, $new_token, Response::HTTP_FOUND);
        }catch(Exception $e){
            return $apiRepository->failedResponse($e->getMessage());
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

            return $apiRepository->successResponse(trans('logout_success'), null, null, Response::HTTP_OK);

        } catch (Exception $e) {
            return $apiRepository->failedResponse($e->getMessage());
        }
    }
}
