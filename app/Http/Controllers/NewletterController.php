<?php

namespace App\Http\Controllers;

use App\Cv;
use App\Subcribe;
use Illuminate\Http\Request;
use League\CommonMark\Block\Element\Document;
use Riverskies\LaravelNewsletterSubscription\NewsletterSubscription;

class NewletterController extends Controller
{
     public function store(Request $request)
    {
     $this->validate($request,array( 
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],));
        $sub =new Subcribe();
        $sub->email = $request->email;
      
        $sub->save();
        return redirect(route('home'))->withSuccess('Utilisateur créer avec sucess');
    
    }
    
   
    
    
}
