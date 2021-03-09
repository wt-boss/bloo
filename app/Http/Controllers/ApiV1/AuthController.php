<?php

namespace App\Http\Controllers\ApiV1;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth as JWTAuthJWTAuth;

class AuthController extends Controller
{
    /**
     * Store new User resource
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        // Create user by validated rules
        $validatedData = $request->validated();
        $user = new User($validatedData);
        $user->role = 1;
        $user->save();

        return response()->json([
            'status' => true,
            'success' => 'New Account has been Successfuly created',
            'content' => $user,
        ]);
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
        $this->validate($request, [
            'email' => 'required|email|string',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);
        // Authentication failed
        if(!$token){
            return response()->json(
                [
                    'status' => false,
                    'content' => 'Your credentials don\'t match with our records',
                ]
            );
        }
        // Authentication passed
        return response()->json(
            [
                'status' => true,
                'content' => 'Successfully authenticated',
                'token' => $token,
            ]
        );      
    }

    /**
     * Refresh the authenticated user's token
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken()
    {
        try{
            $new_token = JWTAuth::refresh(true, true);

            return response()->json([
                'status' => 'Token has been successfully refreshed',
                'content' => $new_token,
            ]);
        }catch(JWTException $e){
            return response()->json([
                'status' => false,
                'content' => 'Cannot refresh token now!',
            ]);
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
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'status' => true,
                'content' => 'Successfully logged out',
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'content' => 'Something went wrong!',
            ]);
        }
    }
}
