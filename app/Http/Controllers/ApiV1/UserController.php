<?php

namespace App\Http\Controllers\ApiV1;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display user's details
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
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
    public function update(UpdateUserRequest $user_request, Request $request)
    {
        $token = $request->header('Authorization');
        
        $user = JWTAuth::user();
        // if ($user->isDirty()) {
        //     return response()->json([
        //         'status' => true,
        //         'message' => 'Nothing has been changed',
        //         'content' => $user,
        //         'token' => $token,
        //     ]);
        // }

        $data = $user_request->validated();
        $user->save($data);

        return response()->json([
            'status' => true,
            'message' => 'Changes have been successfully updated',
            'content' => $user,
            'token' => $token,
        ]);
    }
}