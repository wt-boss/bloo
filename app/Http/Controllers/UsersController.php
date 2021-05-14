<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role','<>',"3")->get();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { $countries  = Country::where('id','38')
        ->orwhere('id','42')
        ->orwhere('id','50')
        ->orwhere('id','79')
        ->orwhere('id','67')
        ->orwhere('id','43')
        ->orwhere('id','161')
        ->orwhere('id','7')
        ->orwhere('id','51')
        ->get();
        return view('admin.users.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $this->validate($request, User::rules());
        User::create(request()->all());
        return redirect(route('users.index'))->withSuccess('Utilisateur créer avec sucess');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
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
        $user = User::findOrFail($id);
         $parameters = $request->all();
         if(isset($parameters["avatar"]))
         {
             $avatar = $parameters["avatar"];
             $extention = $extension = $avatar->getClientOriginalExtension();
             if($extension == "jpg" ||$extension == "png" || $extension == "gif" || $extension == "jpeg")
             {
                 $user->update($request->all());
                 return redirect()->route('users.index')->withSuccess('Modification Effectuée');
             }
             else
             {
                 return back()->withErrors("Selectionner une image de type 'jpeg', 'jpg', 'gif' ou 'png'");
             }
         }
         else
             {
                 $user->update($request->all());
                 return back()->withErrors("Selectionner une image de type 'jpeg', 'jpg', 'gif' ou 'png'");
             }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->withSuccess(trans('Utilisateurs suprimé avec success'));

    }

}
