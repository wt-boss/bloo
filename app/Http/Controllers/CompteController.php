<?php

namespace App\Http\Controllers;

use App\Entreprise;
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
        $comptes = Entreprise::with('users','operations')->get();
        $users = User::where('role','4')->get();
        return view('admin.compte.index',compact('comptes','users'));
    }

    public function savegift(Request $request)
    {
       $parameters = $request->all();
       $user = User::findOrFail($parameters['user_id']);
       $entreprise = Entreprise::findOrFail($parameters['entreprise_id']);
       $user->entreprises()->attach($entreprise);
       $comptes  = Entreprise::all();
        $users = User::where('role','4')->get();
       return view('admin.compte.index',compact('comptes','users'))->withSuccess('Operation attribuer avec success');
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
        return view('admin.compte.create');
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
        return view('admin.compte.index',compact('comptes'))->withSuccess('Compte creer avec success');
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
