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
        $result = ["items" =>$countries,"state"=>"Success"];
        return response()->json($result);
    }

    public function getstatates($id)
    {
        $states  = State::where('country_id',$id)->get();
        $result = ["items" =>$states,"state"=>"Success"];
        return response()->json($result);

    }

    public function getcities($id)
    {
        $cities  = City::where('state_id',$id)->get();
        $result = ["items" =>$cities,"state"=>"Success"];
        return response()->json($result);
    }
}
