<?php

namespace App\Http\Controllers\API;

use App\City;
use App\Http\Controllers\Controller;
use App\Operation;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OperationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register', 'searchoperation']]);
        $this->guard = "api";
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $operations = Operation::paginate(10);
        return response()->json($operations,200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchoperation(Request $request)
    {
        $id = $request['id'];
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
            $result = ["items" =>null,"states"=>"error"];
        }
        else
        {
            $result = ["items" =>$CityOperation,"states"=>"success"];
        }
        return response()->json($result,200);
    }


}
