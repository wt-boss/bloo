<?php

namespace App\Http\Controllers;

use App\Entreprise;
use App\Operation;
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
        $comptes = Entreprise::all();
        $operations = Operation::all();
        $operateurs = User::where('role','1')->get();
        $lecteurs = User::where('role','0')->get();
        return view('admin.dashboard',compact('user','comptes','operateurs','operations','lecteurs'));
    }

    public function language()
	{
        Session::put('locale', session('locale') == 'fr' ? 'en' : 'fr');
        Session::put('fallback_locale', session('fallback_locale') == 'fr' ? 'en' : 'fr');
		return redirect()->back();
	}

}
