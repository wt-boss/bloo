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
     * Store new User resource
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $token = Str::random(80);

        $user = new User($validatedData);
        $user->id = User::all()->last()->id + 1;
        $user->api_token = Hash::make($token);
        $user->save();

        return response()->json(
            [
                'status' => true,
                'success' => 'New Account has been Successfuly created',
            ], 
                200, 
            [
                'token' => $token,
            ]
        );
    }

    /**
     * Display user's details
     * 
     * @param User $user
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return (!$user) ? response()->json(
                [
                'status' => false,
                'error' => 'User doesn\'t exists',
                ],
                200
            ) : response()->json(
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
     */
    public function update(User $user, Request $request, AuthRepository $authRepository)
    {  
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'numeric|size:9',
            'phonepaiement' => 'numeric|size:9',
            'country_id' => 'exists:countries,id',
            'state_id' => 'exists:states,id',
            'city_id' => 'exists:cities,id',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
        
        $user->save($authRepository->updating($request));

        return response()->json(
            [
                'status' => true,
                'success' => $user,
            ], 
                200, 
            [
                'token' => $user->token,
            ]
        );
    }
}