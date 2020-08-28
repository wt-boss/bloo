<?php

namespace App\Http\Controllers\API;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getcountries()
    {
        $countries  = Country::where('name','Cameroon')
            ->orwhere('name','Central African Republic')
            ->orwhere('name','Congo')
            ->orwhere('name','Gabon')
            ->orwhere('name','Equatorial Guinea')
            ->orwhere('name','Chad')
            ->orwhere('name','Nigeria')
            ->orwhere('name','Angola')
            ->get();
        $result = ["items" =>$countries,"states"=>"success"];
        return response()->json($countries,200);
    }
    public function getstates($id)
    {
        $states  = State::where('country_id',$id)->get();
        $result = ["items" =>$states,"states"=>"success"];
        return response()->json($states,200);
    }

    public function getcities($id)
    {
        $cities  = City::where('state_id',$id)->get();
        $result = ["items" =>$cities,"states"=>"success"];
        return response()->json($cities,200);
    }
}
