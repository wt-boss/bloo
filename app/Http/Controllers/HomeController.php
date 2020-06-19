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
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];
        return view('home', compact('widget'));
    }

    /**
     * Show the admin dashbord
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {
        $user = auth()->user();
        return view('admin.index',compact('user'));
    }

    /**
     * Change the language of the application
     * @return \Illuminate\Http\RedirectResponse
     */
    public function language()
	{
		Session::put('locale', session('locale') == 'fr' ? 'en' : 'fr');
		return redirect()->back();
	}

}
