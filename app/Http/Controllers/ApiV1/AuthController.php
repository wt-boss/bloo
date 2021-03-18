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
        // Create user by validated rules
        $user = new User($request->validated());
        $user->role = 1;
        $user->active = 1;
        $user->save();

        return $apiRepository->successResponse(trans('new_account'), $user, null, 201);
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
        return $apiRepository->failedResponse(trans('user_not_found'), 404);
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

            return $apiRepository->successResponse(trans('refreshed_token'), null, $new_token, 202);

        }catch(JWTException $e){
            return $apiRepository->failedResponse(trans('general_error'), 500);
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

            return $apiRepository->successResponse(trans('logout_success'), null, null);

        } catch (JWTException $e) {
            return $apiRepository->failedResponse(trans('general_error'));
        }
    }
}
