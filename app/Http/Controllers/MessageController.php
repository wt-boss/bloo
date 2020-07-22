<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessageSent;
use App\Message;
use App\Operation;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::with('operations')->where('id',auth()->user()->id)->get()->first();
        return view('admin.messagerie.index',compact('user'));
    }

    public function show(Request $request,$id){
        $operation = Operation::findOrFail($id);
        return view('admin.messagerie.index',compact('operation'));
    }

    public function users($id){
        $operation = Operation::with('users')->findOrFail($id);
        $users = $operation->users()->get();
        return response()->json($users);
    }


    public function privateMessages(User $user,$id)
    {
        $operation = Operation::findOrFail($id);

        $privateCommunication = Message::with('user')
            ->where(['user_id' => auth()->id() , 'receiver_id' => $user->id])
            ->where(['operation_id' => $operation->id])
            ->get();
        dd($privateCommunication);
        return $privateCommunication;
    }
    public function sendPrivateMessage(Request $request,User $user,$id)
    {
        $input = $request->all();
        $input['receiver_id'] = $user->id;
        $input['operation_id'] = $id;
        $message = auth()->user()->messages()->create($input);
        broadcast(new PrivateMessageSent($message->load('user')))->toOthers();
        return response(['status'=>'Message private send successfuly','message'=>$message]);
    }
}
