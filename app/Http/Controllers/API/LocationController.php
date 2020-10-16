<?php

namespace App\Http\Controllers\API;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function getcountries()
    {
        $countries  = Country::where('id','38')
            ->orwhere('id','42')
            ->orwhere('id','50')
            ->orwhere('id','79')
            ->orwhere('id','67')
            ->orwhere('id','43')
            ->orwhere('id','161')
            ->orwhere('id','7')
            ->orwhere('id','51')
            ->get();
        $result = ["items" =>$countries,"states"=>["success"]];
        return response()->json($countries,200);
    }
    public function getstates($id)
    {
        $states  = State::where('country_id',$id)->get();
        $result = ["items" =>$states,"states"=>["success"]];
        return response()->json($states,200);
    }

    public function getcities($id)
    {
        $cities  = City::where('state_id',$id)->get();
        $result = ["items" =>$cities,"states"=>["success"]];
        return response()->json($cities,200);
    }

    public function getoperationscities()
    {
        $userid = auth()->user();
        dd($userid);

    }
}
