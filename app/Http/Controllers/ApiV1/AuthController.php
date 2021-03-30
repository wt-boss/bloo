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
    public $api;
    public function __construct(ApiRepository $apiRepository)
    {
        $this->api = $apiRepository;
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
            return $this->api->jsonResponse(true, trans('refreshed_token'), Response::HTTP_FOUND, null, $new_token);
        }catch(Exception $e){
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }

    /**
     * Log the authenticated user out
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $token = $request->header('Authorization');

        try {
            JWTAuth::invalidate($token);

            return $this->api->jsonResponse(true, trans('logout_success'), Response::HTTP_OK);

        } catch (Exception $e) {
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }
}
