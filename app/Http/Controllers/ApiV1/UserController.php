<?php

namespace App\Http\Controllers\ApiV1;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Api\User\AuthRepository;

class UserController extends Controller
{
    /**
     * Display user's details
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $user = Auth::user();

        return response()->json(
            [
                'status' => true,
                'content' => $user,
            ], 
            200,
            [
                'token' => $user->api_token,
            ]
        );
    }

    /**
     * Update user's details
     * 
     * @return Illuminate\Http\JsonResponse
     * 
     */
    public function update(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = User::findOrFail(Auth::id());
        $user->save($data);

        return response()->json(
            [
                'status' => true,
                'content' => $user,
            ], 
                200, 
            [
                'token' => $user->api_token,
            ]
        );
    }
}