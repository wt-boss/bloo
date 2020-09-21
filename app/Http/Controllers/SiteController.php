<?php

namespace App\Http\Controllers;

use App\Country;
use App\Operation;
use App\User;
use Illuminate\Http\Request;
use App\Site;
use Illuminate\Validation\Rule;
use Validator;
class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::orderby('id')->get();
        return response()->json($sites);
    }

    public function operations($id)
    {
//        $operation = Operation::with('sites')->findOrFail($id);
//        $sites = $operation->sites()->get();
//        return response()->json($sites);
        $userid = auth()->user()->id;
        $User = User::findOrfail($id);
        $country = $User->country_id;
        dd($country);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $parameters = $request->all();


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

        foreach ($countries as $country)
        {
            similar_text($country->name,$parameters['pays'], $perc);
            if($perc > 50)
            {
                $parameters['country_id'] = $country->id;
            }

        }
        $site = Site::where('lat',$parameters['lat'])
            ->where('lng',$parameters['lng'])
            ->where('lng',$parameters['operation_id'])
            ->get()->first();

        if(isset($site))
        {
          $result = ["Erreur" => "Donnees deja en base"];
        }
        else{
            $sites = Site::create($parameters);
            $result = Site::orderby('id')->get()->last();
        }
        return response()->json($result);
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
        Site::destroy($id);
        return back();
    }
}
