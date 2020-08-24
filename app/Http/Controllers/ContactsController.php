<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
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
    public function store(Request $request)
    {

        Mail::to(config('mail.from.address'))
            ->send(new Contact($request->except('_token')));
        return redirect()->route('home');
    }
}
