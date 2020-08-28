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

        $piece = Piece::create($request->all());
        return response("Photos enregistrer",200);
    }

    public function test()
    {
        return auth()->user();
    }

    public function useroperation()
    {
        $user = auth()->user();
        $User = User::with('operations')->findOrFail($user->id);
        $Operation = collect();
        $result = ["items" => $User,"operation" => null,'sites' => null ,'form' =>  null, "states"=>["success"]];

        $operations = $user->operations()->get();
        foreach($operations as $operation)
        {
            if($operation->status === "EN COUR")
            {
                $Operation->push($operation);
            }
        }

        $compteur = $Operation->count();
        if ($compteur != 0)
        {
            $lastoperation = $Operation->last();
            $UserOperation = Operation::with('sites','form')->findOrFail($lastoperation->id);
            $sites = $UserOperation->sites()->get();
            $form_url = asset('forms/'.$UserOperation->form->code.'/view');
            $result = ["items" => $User,"operation" => $UserOperation,'sites' => $sites ,'form' =>  $form_url, "states"=>["success"]];
        }

        return response()->json($result,200);
    }
}
