<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Entreprise;
use App\Helpers\Helper;
use App\Operation;
use App\Questionnaire;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpseclib\Crypt\Hash;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


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
        $rapports = Operation::where('status','TERMINER')->get();
        return view('admin.dashboard',compact('user','comptes','operateurs','operations','lecteurs','rapports'));
    }
    public function language()
	{
        Session::put('locale', session('locale') == 'fr' ? 'en' : 'fr');
        Session::put('fallback_locale', session('fallback_locale') == 'fr' ? 'en' : 'fr');
		return redirect()->back();
	}
	public function profile(){
        $users = DB::select("select users.id, users.first_name, users.last_name,users.avatar, users.email, count(is_read) as unread
        from users LEFT  JOIN  messages ON users.id = messages.user_id and is_read = 0 and messages.receiver_id = " . Auth::id() . "
        where users.id != " . Auth::id() . "
        group by users.id, users.first_name, users.last_name, users.avatar, users.email");
        return view('admin.users.profile',compact('users'));
    }

    public function allcountries()
    {
        $countries  = Country::where('name','Cameroon')
            ->orwhere('name','Central African Republic')
            ->orwhere('name','Congo')
            ->orwhere('name','Gabon')
            ->orwhere('name','Equatorial Guinea')
            ->orwhere('name','Chad')
            ->orwhere('name','Nigeria')
            ->orwhere('name','Angola')
            ->get();




        return response()->json($countries);
    }

    public function allstates()
    {
        $states  = State::where('country_id','38')
            ->orwhere('country_id','42')
            ->orwhere('country_id','50')
            ->orwhere('country_id','79')
            ->orwhere('country_id','67')
            ->orwhere('country_id','43')
            ->orwhere('country_id','161')
            ->orwhere('country_id','7')
            ->get();
        // return response()->json($states);
        $viewData = Helper::buildCities($states);

        return response()->json($viewData);
    }

    public function allcities()
    {
        $cities  = City::where('country_id','38')
            ->orwhere('country_id','42')
            ->orwhere('country_id','50')
            ->orwhere('country_id','79')
            ->orwhere('country_id','67')
            ->orwhere('country_id','43')
            ->orwhere('country_id','161')
            ->orwhere('country_id','7')
            ->get();

        $viewData = Helper::buildCities($cities);

        return response()->json($viewData);

        // return response()->json($cities);
    }
}
