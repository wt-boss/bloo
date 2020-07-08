<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use App\User;
use Illuminate\Http\Request;
use phpseclib\Crypt\Hash;
use Illuminate\Support\Facades\Session;


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
    public function index2()
    {

        $questionnaires = auth()->user()->questionnaires;
        return view('home2',compact('questionnaires'));
    }
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];
        return view('home', compact('widget'));
    }
    public function admin()
    {
        $user = auth()->user();
        return view('admin.top-nav',compact('user'));
    }
    public function language()
	{
		Session::put('locale', session('locale') == 'fr' ? 'en' : 'fr');
		return redirect()->back();
	}

}
