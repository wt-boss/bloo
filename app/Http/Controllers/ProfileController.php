<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $User = User::with('operations')->findOrFail(auth()->user()->id);
        $operations = $User->operations()->with('form','entreprise')->get();
        $countries  = Country::all();
        $current_user = Auth::user();
        return view('profile',compact('operations','countries','current_user'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);


        $user = User::findOrFail(Auth::user()->id);

        $update = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $request->input('new_password'),
            'avatar' => $request->input('avatar'),
            'phonepaiement' => $request->input('phonepaiement'),
            'country_id' => $request->input('country_id'),
            'state_id' => $request->input('state_id') ,
            'city_id' => $request->input('city_id')
        ];


        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->update($update);
            } else {
                return redirect()->back()->withErrors(trans('Current password incorrect'));
            }
        }

        return redirect()->route('profile')->withSuccess(trans('Personal information successfully updated'));
    }
}
