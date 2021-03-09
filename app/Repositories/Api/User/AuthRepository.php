<?php

namespace App\Repositories\Api\User;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthRepository{

    /**
     * Update new User resource
     * 
     * @param Illuminate\Http\Request $request
     */
    public function updating(Request $request)
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'phonepaiement' => $request->phonepaiement,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
        ];

        $user = User::findOrFail(Auth::id());
        $user->save($data);
    }
}