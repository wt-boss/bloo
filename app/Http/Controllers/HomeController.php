<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Entreprise;
use App\Helpers\Helper;
use App\Notification;
use App\Operation;
use App\Questionnaire;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpseclib\Crypt\Hash;
use Illuminate\Support\Facades\Session;
use PHPUnit\TextUI\Help;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

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
        return view('home');
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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
//    public function index()
//    {
//        $users = User::count();
//
//        $widget = [
//            'users' => $users,
//            //...
//        ];
//        return view('home', compact('widget'));
//    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {
        $user = auth()->user();
        $countries  = Country::where('name','Cameroon')
            ->orwhere('name','Central African Republic')
            ->orwhere('name','Congo')
            ->orwhere('name','Gabon')
            ->orwhere('name','Equatorial Guinea')
            ->orwhere('name','Chad')
            ->orwhere('name','Nigeria')
            ->orwhere('name','Angola')
            ->orwhere('name', 'The Democratic Republic Of The Congo')
            ->get();
        $diagram =  collect();
        $diagram->push(['Client','Operation']);
        if($user->role === 5)
        {
            $comptes = Entreprise::with('operations')->get();
            foreach ($comptes as $compte)
            {
                $operations = $compte->operations()->count();
                $table = [$compte->nom,$operations];
                $diagram->push($table);
            }
            $operations = Operation::all();
            $operateurs = User::where('role','1')->get();
            $lecteurs = User::where('role','0')->get();
            $rapports = Operation::where('status','TERMINER')->get();
        }
        else{
            $comptes = $user->entreprises()->get();
            $operations = collect(); //Toutes les operations de l'utilisateurs connecté.
            $operateurs = collect(); //Tout les operateurs des operations.
            $lecteurs = collect(); //Tous les lecteurs des operations.
            $rapports = collect();
            foreach ($comptes as $entreprise)
            {
                $countoperations = $entreprise->operations()->count();
                $table = [$entreprise->nom,$countoperations];
                $diagram->push($table);

            }
            $User = User::with('operations')->findOrFail($user->id);
            $operations = $User->operations()->with('form','entreprise')->get();
            foreach ($operations as $operation)
            {
                $AllUsers = $operation->users()->get();
                foreach ($AllUsers as $User)
                {
                    if($User->role === 1)
                    {
                        $operateurs->push($User);
                    }
                    else if ($User->role === 0)
                    {
                        $lecteurs->push($User);
                    }
                }
            }
        }
        return view('admin.dashboard',compact('user','comptes','operateurs','operations','lecteurs','rapports', 'countries','diagram'));
    }


    public function realtimeboard()
    {
        $user = auth()->user();
        $diagram =  collect();
        $diagram->push(['Client','Operation']);
        if($user->role === 5)
        {
            $comptes = Entreprise::with('operations')->get();
            foreach ($comptes as $compte)
            {
                $operations = $compte->operations()->count();
                $table = [$compte->nom,$operations];
                $diagram->push($table);
            }
            $operations = Operation::all();
            $operateurs = User::where('role','1')->get();
            $lecteurs = User::where('role','0')->get();
            $rapports = Operation::where('status','TERMINER')->get();
        }
        else{
            $comptes = $user->entreprises()->get();
            $operations = collect(); //Toutes les operations de l'utilisateurs connecté.
            $operateurs = collect(); //Tout les operateurs des operations.
            $lecteurs = collect(); //Tous les lecteurs des operations.
            $rapports = collect();
            foreach ($comptes as $entreprise)
            {
                $countoperations = $entreprise->operations()->count();
                $table = [$entreprise->nom,$countoperations];
                $diagram->push($table);

            }
            $User = User::with('operations')->findOrFail($user->id);
            $operations = $User->operations()->with('form','entreprise')->get();
            foreach ($operations as $operation)
            {
                $AllUsers = $operation->users()->get();
                foreach ($AllUsers as $User)
                {
                    if($User->role === 1)
                    {
                        $operateurs->push($User);
                    }
                    else if ($User->role === 0)
                    {
                        $lecteurs->push($User);
                    }
                }
            }
        }
        return response()->json($diagram);

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
        $User = User::with('operations')->findOrFail(auth()->user()->id);
        $operations = $User->operations()->with('form','entreprise')->get();
        return view('admin.users.profile',compact('users','operations'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
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
        $class = 'operateurcountries';
        $viewData = Helper::buildDashboardTable($countries, $class);
        return response()->json($viewData);
    }

    public function jsonotifications()
    {
        $count = auth()->user()->notifications->count();
        $viewData = Helper::buildUsersNotification(auth()->user()->notifications,$count);
        return response()->json($viewData);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
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
        $class = 'operateurstates';
        $viewData = Helper::buildDashboardTable($states,$class);
        return response()->json($viewData);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

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
        $class = 'operateurcities';
        $viewData = Helper::buildDashboardTable($cities,$class);
        return response()->json($viewData);
    }

    public function jsonmapcities()
    {
        $cities  = City::where('country_id','38')
            ->orwhere('country_id','42')
            ->orwhere('country_id','50')
            ->orwhere('country_id','79')
            ->orwhere('country_id','67')
            ->orwhere('country_id','43')
            ->orwhere('country_id','161')
            ->orwhere('country_id','7')
            ->get()->pluck('name','id');
        return response()->json($cities);
    }



    public function jsonmapcountries(){
        $states  = Country::where('id','38')
            ->orwhere('id','42')
            ->orwhere('id','50')
            ->orwhere('id','79')
            ->orwhere('id','67')
            ->orwhere('id','43')
            ->orwhere('id','161')
            ->orwhere('id','7')
            ->orwhere('name', 'The Democratic Republic Of The Congo')
            ->get()->pluck('name','id');;
        return response()->json($states);
    }

    public function jsonmapcountries2(){
        $states  = Country::where('id','38')
            ->orwhere('id','42')
            ->orwhere('id','50')
            ->orwhere('id','79')
            ->orwhere('id','67')
            ->orwhere('id','43')
            ->orwhere('id','161')
            ->orwhere('id','7')
            ->get();
        return response()->json($states);
    }

    public function operateurcountries(Request $request)
    {
        $country_id = $request->input('country_id');
        $operateurs = User::where('role','1')->where('country_id',$country_id )->get();
        $viewData = Helper::buildOperateurs($operateurs);
        return response()->json($viewData);
    }

    public function operateurstates(Request $request)
    {
        $state_id = $request->input('state_id');
        $operateurs = User::where('role','1')->where('city_id',$state_id )->get();
        $viewData = Helper::buildOperateurs($operateurs);
        return response()->json($viewData);
    }

    public function operateurcities(Request $request)
    {
        $city_id = $request->input('city_id');
        $operateurs = User::where('role','1')->where('city_id',$city_id )->get();
        $viewData = Helper::buildOperateurs($operateurs);
        return response()->json($viewData);
    }
}
