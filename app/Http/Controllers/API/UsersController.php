<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Operation;
use App\Piece;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->guard = "api";
    }

    public function  pieces(Request $request)
    {
        $parameters = $request->all();
        $parameters['user_id'] = auth()->user()->id;
        $piece = Piece::create($parameters);
        return response("Photos enregistrer",200);
    }
    public function usersoperation()
    {
        $user = auth()->user();
        $operations = $user->operations()->where('status','CREER')->count();
        if($operations === 0)
        {
            $operation = new Operation();
            $result = ["items" => $operation,"state"=>"Error"];
        }
        else{
            $result = ["items" =>$operations,"state"=>"Success"];
        }
        return response()->json($result);
    }
}
