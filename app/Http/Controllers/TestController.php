<?php

namespace App\Http\Controllers;

use App\City;
use App\Site;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function searchoperation($id)
    {
        $city = City::findOrFail($id);
        $name = $city->name;
        $sites = Site::with('operation')->where('ville',$name)->get();
        $CityOperation = collect();
        $AllOperation = collect();
        foreach ($sites as $site)
        {
            $operation = $site->operation()->with('form')->get();
            $AllOperation->push($operation);
        }
        $TrueOperation = $AllOperation->unique();
        foreach ($TrueOperation as $items)
        {
            foreach($items as $item)
            {
                if($item->status === "CREER")
                {
                    $CityOperation->push($item);
                }
            }
        }
        $number = $CityOperation->count();
        if($number === 0)
        {
            $result = ["items" =>null,"states"=>["error"]];
        }
        else
            {
                $result = ["items" =>$CityOperation,"states"=>["success"]];
            }
        return response()->json($result,200);
    }
}
