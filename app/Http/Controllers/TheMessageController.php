<?php

namespace App\Http\Controllers;

use App\Admin_Client;
use App\Message;
use App\Operation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Pusher\PusherException;

class TheMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $AuthUser = Auth::user();
        $users = collect();
        $clientId = array();
        $operation = "";
        $operations = "";
        //Si le client est un Admin cote Bloo, On recupere les clients qui lui sont assigne et les affiches;
        $clientIdArray = Admin_Client::where('admin_id',$AuthUser->id)->get("client_id");
        foreach($clientIdArray as $client){
            $clientId[] = $client->client_id;
        }
        $clientId = implode(",",$clientId);
        $clients = DB::select("select users.id, users.first_name, users.last_name,users.avatar, users.email, count(is_read) as unread
        from users LEFT  JOIN  messages ON users.id = messages.receiver_id and is_read = 0 and messages.user_id = " . Auth::id() . "
        where users.id in(" . $clientId . ")
        group by users.id, users.first_name, users.last_name, users.avatar, users.email");
        return view('admin.themessage.index',compact('clients'));
    }


    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
       Message::where(['user_id' => $my_id, 'receiver_id' => $user_id])->update(['is_read' => 1]);


        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('user_id', $user_id)->where('receiver_id', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('user_id', $my_id)->where('receiver_id', $user_id);
        })->get();

        return view('messages.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->user_id = $from;
        $data->receiver_id = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        try {
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
        } catch (PusherException $e) {
        }

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }

}
