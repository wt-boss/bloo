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
use App\Repositories\Api\ApiRepository;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public $api, $token;

    public function __construct(ApiRepository $apiRepository, Request $request)
    {
        $this->api = $apiRepository;
        $this->token = $request->header('Authorization');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->api->jsonResponse(false, $validator->errors()->first(), Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }

        $user = User::where('email', $request->email)->first();

        if($user){
            $password = Hash::check($request->password, $user->password);
            if(!$password){
                return $this->api->jsonResponse(false, trans('credentials_not_found'));
            }else if ($user->active === 0) {
                return $this->api->jsonResponse(false, trans('disabled_account'));
            }

            $token = JWTAuth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'active' => 1,
            ]);

            return $this->api->jsonResponse(true, trans('auth_success'), Response::HTTP_OK, null, $token);
        }
        return $this->api->jsonResponse(false, trans('user_not_found'), Response::HTTP_OK);
    }

    /**
     * Refresh the authenticated user's token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken()
    {
        try{
            $new_token = JWTAuth::parseToken()->refresh(true, true);
            $expireAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'.Auth::id() , true , $expireAt);
            return $this->api->jsonResponse(true, trans('refreshed_token'), Response::HTTP_OK, null, $new_token);
        }catch(Exception $e){
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }

    /**
     * Log the authenticated user out
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate($this->token);
            return $this->api->jsonResponse(true, trans('logout_success'), Response::HTTP_OK);

        } catch (Exception $e) {
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }

    /**
     * Save the authenticated user's device token
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveDeviceToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_token' => 'required',
        ]);

        if($validator->fails()){
            return $this->api->jsonResponse(false, $validator->errors()->first(), Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
        }
        // return $request->device_token;
        try{
            $user = JWTAuth::user();
            $user->device_token = $request->device_token;
            $user->save();
            return $this->api->jsonResponse(true, trans('token_saved'), Response::HTTP_OK, JWTAuth::user()->device_token);
        }catch(Exception $e){
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }

    /**
     * Update authenticated user's availabity
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function available()
    {
        try{
            $user = JWTAuth::user();
            $user->available = $user->available ? 0 : 1;
            $user->save();
            return $this->api->jsonResponse(true, trans('availability_updated'), Response::HTTP_OK);
        }catch(Exception $e){
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }
}
