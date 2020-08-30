<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Notification_emailController extends Controller
{
    public function lecteurs(){
        return view('email.mail_lecteur');
    }
}
