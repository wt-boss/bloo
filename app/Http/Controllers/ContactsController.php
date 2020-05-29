<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\ContactMessageCreated;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;


class ContactsController extends Controller
{
    public function create()
    {
    return view('pages.contact');
    }



    public function store(ContactRequest $request)
    {

        $message = Message::create($request->only('name','email', 'subject', 'message'));

        Mail::to(config('krada.admin_support_email'))
        ->send(new ContactMessageCreated($message));
        session::flash('success','Nous vous Répondrons Dans Les Plus Brefs Delais!');
        return redirect()->route('home');

    }
}
