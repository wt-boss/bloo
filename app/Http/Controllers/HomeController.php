<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Questionnaire;
use App\User;
use Illuminate\Http\Request;
use phpseclib\Crypt\Hash;
=======
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
>>>>>>> kirra

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
<<<<<<< HEAD
        $questionnaires = auth()->user()->questionnaires;
        return view('home',compact('questionnaires'));
    }

=======
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('home', compact('widget'));
    }
    public function admin()
    {


        return view('admin');
    }


    public function language()
	{
		Session::put('locale', session('locale') == 'fr' ? 'en' : 'fr');

		return redirect()->back();
	}
>>>>>>> kirra
}
