<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Operation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OperationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register',]]);
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
        return response()->json($operations);
    }

    public function  operationsville()
    {
//        $operations = Operation::where('ville',$ville)->paginate(10);
//        if(isset($operations))
//        {
//           $result = $operations;
//        }
//        else
//            {
//                $result = "Aucune operation n'est disponible";
//
//            }
        $result ="test";
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
