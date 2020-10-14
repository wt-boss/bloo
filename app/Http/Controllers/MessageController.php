<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessageSent;
use App\Message;
use App\Notifications\MessageRated;
use App\Operation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Message::where(['user_id' => $user_id, 'receiver_id' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('user_id', $user_id)->where('receiver_id', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('user_id', $my_id)->where('receiver_id', $user_id);
        })->get();

        return view('messages.index', ['messages' => $messages]);
    }


    public function getOperationMessage($user_id,$operation_id){
        $my_id = Auth::id();
        // Make read all unread message
        Message::where(['user_id' => $user_id, 'receiver_id' => $my_id, 'operation_id' => $operation_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id,$operation_id) {
            $query->where('user_id', $user_id)->where('receiver_id', $my_id)->where('operation_id', $operation_id);
        })->oRwhere(function ($query) use ($user_id, $my_id,$operation_id) {
            $query->where('user_id', $my_id)->where('receiver_id', $user_id)->where('operation_id', $operation_id);
        })->get();

        return view('messages.index', ['messages' => $messages]);
    }


    public function deleteDuplicate($user, $image)
    {
        DB::table('notifications')
            ->whereNotifiableId($image->user->id)
            ->whereNull('read_at')
            ->where('data->image_id', $image->id)
            ->where('data->user', $user->id)
            ->delete();
    }


    public function sendMessage(Request $request)
    {
        $user = auth()->user();
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;
        $operation_id = $request->operation_id;

        $data = new Message();
        $data->user_id = $from;
        $data->receiver_id = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        if(isset($operation_id))
        {
            $data->operation_id = $operation_id;
        }
        $data->save();

         // Notification
         $other = User::findOrFail($to);
         $other->notify(new MessageRated($message, $to, $from));

         $pusher = App::make('pusher');
         $data = ['from' => $from, 'to' => $to , 'id' => $operation_id ]; // sending from and to user id when pressed enter
         $pusher->trigger('my-channel', 'message-event', $data);
    }


    public function getUser(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::findOrFail($user_id);
        return response()->json($user);
    }


    public function index()
    {
         //$user = User::with('operations')->where('id',auth()->user()->id)->get()->first();
         //$operation = $user->operations->first();
        $AuthUser = Auth::user();
        $users = collect();
        $operation = "";
        $operations = "";
        if($AuthUser->role === 5)
        {
            $operations = Operation::all();

        }
        else if ($AuthUser->role === 1)
        {
            /**
             * On recupere l'operation a laquelle il participe;
             */
            $operation = $AuthUser->operations()->get()->last();
            /**
             * Si il appartient effectivement a une operation on recupere l'entreprise qui gere cette operation;
             */
            if($operation !== null)
                {
                   $entreprise = $operation->entreprise()->get()->last();
                   $AllUsers = $entreprise->users()->get();
                    /**
                     * On recherche l'acount Manager de cette operation;
                     */
                   foreach ($AllUsers as $user)
                   {
                       if ($user->role === 4)
                       {
                          $users->push($user);
                       }
                   }
                }
        } else
        {
              //$operations = collect();
              $Entreprises = $AuthUser->entreprises()->get();
//               foreach ($Entreprises as $Entreprise)
//              {
//                 $Operations = $Entreprise->operations()->get();
//                 foreach ($Operations as $Operation)
//                 {
//                     $operations->push($Operation);
//                 }
//              }
            $User = User::with('operations')->findOrFail($AuthUser->id);
            $operations = $User->operations()->with('form','entreprise')->get();
        }
        return view('admin.messagerie.index',compact('operations','users','operation'));
    }


    public function show(Request $request,$id){
        $operations = Operation::all();
        $operation  =  Operation::findOrFail($id);
        return view('admin.messagerie.index',compact('operation','operations'));
    }


    public function users(){
        return User::all();
    }


    public function privateMessages(User $user,$id)
    {
        $operation = Operation::findOrFail($id);
        $privateCommunication = Message::with('user')
            ->where(['user_id' => auth()->id(), 'receiver_id' => $user->id])
            ->where(['operation_id' => $operation->id])
            ->orWhere(function ($query) use ($user,$operation) {
                $query->where(['user_id' => $user->id, 'receiver_id' => auth()->id()])
                    ->where(['operation_id' => $operation->id]);
            })
            ->get();
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
