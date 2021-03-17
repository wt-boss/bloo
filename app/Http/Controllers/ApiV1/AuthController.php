<?php

namespace App\Http\Controllers\ApiV1;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\Api\ApiRepository;
use Tymon\JWTAuth\Exceptions\JWTException;

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

            return $apiRepository->successResponse(trans('new_account'), $user);
        } catch (Exception $e) {
            return $apiRepository->failedResponse($e);
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
        
        $user = User::where('email', $request['email'])->first();
        
        try {
            $token = JWTAuth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'active' => 1,
            ]);
            // Authentication failed by account disabled or user not found
            if(!$token){
                $message = (($user) && $user->active === 0) ? trans('disabled_account') : trans('credentials_not_found');
                return $apiRepository->successResponse($message);
            }
            // Authentication success
            return $apiRepository->successResponse(trans('auth_success'), null, $token);

            // Authentication failed globally
        } catch (JWTException $e) {
            return $apiRepository->failedResponse($e);
        }
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
            $new_token = JWTAuth::refresh(true, true);

            return $apiRepository->successResponse(trans('refreshed_token'), null, $new_token);

        }catch(JWTException $e){
            return $apiRepository->failedResponse($e);
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

            return $apiRepository->successResponse(trans('logout_success'));

        } catch (JWTException $e) {
            return $apiRepository->failedResponse($e);
        }
    }
}
