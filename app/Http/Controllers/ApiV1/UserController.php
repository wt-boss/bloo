<?php

namespace App\Http\Controllers\ApiV1;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display user's details
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $token = $request->header('Authorization');
        $user = JWTAuth::user();

        return response()->json([
            'status' => true,
            'content' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Update user's details
     * 
     * @param App\Http\Requests\StoreUserRequest $request
     * 
     * @return Illuminate\Http\JsonResponse 
     */
    public function update(StoreUserRequest $user_request, Request $request)
    {
        $token = $request->header('Authorization');

        $data = $user_request->validated();
        $user = JWTAuth::user();
        $user->save($data);

        return response()->json([
            'status' => true,
            'content' => $user,
            'token' => $token,
        ]);
    }
}