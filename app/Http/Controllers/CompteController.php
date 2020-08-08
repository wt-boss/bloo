<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Entreprise;
use App\Entreprise_user;
use App\State;
use App\User;
use Illuminate\Http\Request;
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
        if(auth()->user()->id === 1)
        {
            $comptes = Entreprise::with('users','operations')->get();
        }
        else
        {
            $comptes = auth()->user()->entreprises()->get();
        }

        $users = User::where('role','4')->get();
        return view('admin.compte.index',compact('comptes','users'));
    }

    public function savegift(Request $request)
    {
        $parameters = $request->all();
        $comptes  = Entreprise::all();
        $users = User::where('role','4')->get();
        $user_entreprise = Entreprise_user::where('user_id',$parameters['user_id'])->where('entreprise_id',$parameters['entreprise_id'])->count();
        if($user_entreprise == 0)
        {
            $user = User::findOrFail($parameters['user_id']);
            $entreprise = Entreprise::findOrFail($parameters['entreprise_id']);
            $user->entreprises()->attach($entreprise);
            return view('admin.compte.index',compact('comptes','users'))->withSuccess('Operation attribuer avec success');
        }
        else {
                return view('admin.compte.index',compact('comptes','users'))->withErrors('Cet Acount Manager a deja ce compte');
            }
    }


    public function donner()
    {
        $entreprises =  Entreprise::all();
        $users = User::where('role','4')->get();
        return view('admin.compte.gift',compact('entreprises','users'));
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
        $state_id = $request->input('states_id');
        $cities = City::where('states_id',$state_id)->get();
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
