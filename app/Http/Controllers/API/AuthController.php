<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if($validator->fails())
        {
            return response(['errors' => $validator->errors()->all()],422);
        }
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->toArray());
        $user['api_token'] = Str::random(80);
        $user->save();
        $response = ['token'=> $user['api_token'] ];
        return response($response,200);
    }

    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user)
        {
            if( Hash::check($request->password,$user->password))
            {
                $token = $user->api_token;
                $response = ['token' => $token];
                return response($response,200);
            }
            else {
                $response = ['error'=>'Password missmatch'];
                return response()->json($response,422);
            }
        }
        else {
            $response = ['error'=>'User does not exist'];
            return response($response,422);
        }
    }
}
