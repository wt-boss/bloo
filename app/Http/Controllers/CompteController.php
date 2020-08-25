<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Entreprise;
use App\Entreprise_user;
use App\Notifications\EventNotification;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use phpDocumentor\Reflection\Types\Compound;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $comptes = "";
        if(auth()->user()->role === 5)
        {
            $comptes = Entreprise::with('users','operations')->get();
        }
        else
        {
            $comptes = auth()->user()->entreprises()->with('users','operations')->get();
        }
        $users = User::where('role','4')->get();
        return view('admin.compte.index',compact('comptes','users'));
    }

    public function savegift(Request $request)
    {
        $parameters = $request->all();
        $comptes  = Entreprise::all();
        $users = User::where('role','4')->get();
        $entreprise = Entreprise::with('users')->findOrFail($parameters['entreprise_id']);
        $AllAcount = $entreprise->users()->get();
        $AcountNow = "";
        foreach ($AllAcount as $Acount)
        {
            if ($Acount->role === 4)
            {
                $AcountNow = $Acount;
            }
        }

        $user_entreprise = Entreprise_user::where('user_id',$parameters['user_id'])->where('entreprise_id',$parameters['entreprise_id'])->count();
        if($user_entreprise == 0 )
        {
            if (!empty($AcountNow))
            {
                $AcountNow->entreprises()->detach($entreprise);
            }
            $user = User::findOrFail($parameters['user_id']);
            $user->entreprises()->attach($entreprise);
            $message = "L'entreprise".$entreprise->nom." vous a été assigné";
            $user->notify(new EventNotification($message));
            $pusher = App::make('pusher');
            $data = ["ajout d'entreprise"]; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel','notification-event', $data);
            return redirect(route('compte.index'))->withSuccess('Operation attribuer avec success');
        }
        else {
            return redirect(route('compte.index'))->withErrors('Cet Acount Manager a deja ce compte');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        return view('admin.compte.create',compact('countries'));
    }

    public function getregions(Request $request)
    {
        $country_id = $request->input('country_id');
        $states = State::where('country_id',$country_id)->get();
        return response()->json($states);
    }

    public function getvilles(Request $request)
    {
        $state_id = $request->input('state_id');
        $cities = City::where('state_id',$state_id)->get();
        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Entreprise::create($request->all());
         $comptes = Entreprise::all();
        $users = User::where('role','4')->get();
        return view('admin.compte.index',compact('comptes','users'))->withSuccess('Compte creer avec success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
