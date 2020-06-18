<?php

namespace App\Http\Controllers;
use phpseclib\Crypt\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Go to the home page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHome(){
        return view('pages.home');
    }

    /**
     * Go to the service page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getServices(){
        return view('pages.services');
    }

    /**
     * Go to the sondage page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSondage(){
        return view('pages.sondages');
    }

    /**
     * Go to the prix page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPrix(){
        return view('pages.prix');
    }

    /**
     * Go to the apropos page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getApropos(){
        return view('pages.apropos');
    }

    /**
     * Go to the Carriere page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCarriere(){
        return view('pages.carriere');
    }

    /**
     * Go to the Intimite page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIntimite(){
        return view('pages.intimite');
    }

    /**
     * Go to the tc page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTc(){
        return view('pages.tc');
    }

    /**
     * Change the Language of systems
     * @return \Illuminate\Http\RedirectResponse
     */
    public function language()
	{
		Session::put('locale', session('locale') == 'fr' ? 'en' : 'fr');
		return redirect()->back();
	}




}
