<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessageSent;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('admin.messagerie.index');
    }
    public function users(){
        return User::all();
    }
    public function privateMessages(User $user)
    {
        $privateCommunication = Message::with('user')
            ->where(['user_id' => auth()->id(), 'receiver_id' => $user->id])
            ->orWhere(function ($query) use ($user) {
                $query->where(['user_id' => $user->id, 'receiver_id' => auth()->id()]);
            })
            ->get();
        return $privateCommunication;
    }
    public function sendPrivateMessage(Request $request,User $user)
    {
        $input = $request->all();
        $input['receiver_id'] = $user->id;
        $message = auth()->user()->messages()->create($input);
        broadcast(new PrivateMessageSent($message->load('user')))->toOthers();
        return response(['status'=>'Message private send successfuly','message'=>$message]);
    }
}
