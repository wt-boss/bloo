<?php

namespace App\Http\Controllers;
use phpseclib\Crypt\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function free()
    {
        return view('pages.free');
    }

    public function getHome(){
        return view('pages.home');
    }
    public function getServices(){
        return view('pages.services');
    }
    public function getSondage(){
        return view('pages.sondages');
    }
    public function getPrix(){
        return view('pages.prix');
    }
    public function getApropos(){
        return view('pages.apropos');
    }
    public function getCarriere(){
        return view('pages.carriere');
    }
    public function getIntimite(){
        return view('pages.intimite');
    }
    public function getTc(){
        return view('pages.tc');
    }
    public function mail_lecteur(){
        return view('emails.maillecteur');
    }
    public function mail_operateur(){
        return view('emails.mailoperateur');
    }
    public function mail_client(){
        return view('emails.mailclient');
    }



    public function language()
	{
		Session::put('locale', session('locale') == 'fr' ? 'en' : 'fr');
		return redirect()->back();
	}




}
