<?php

namespace App\Http\Controllers;

use App\Entreprise;
use App\FormAvailability;
use App\Form;
use App\Operation;
use App\OpUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
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
        $operations = Operation::with('form')->get();

        return view('admin.operation.index', compact('operations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.operation.create');
    }

    public function entreprise()
    {
        return view('admin.operation.entreprise');
    }


    public function saventreprise(Request $request)
    {
        $parameters = $request->all();
        $entreprise = new Entreprise();
        $entreprise->user_id = Auth::user()->id;
        $entreprise->nom = $parameters['nom'];
        $entreprise->addrese = $parameters['adresse'];
        $entreprise->Numero_contribuable =  $parameters['contribuable'];
        $entreprise->numero_siret =  $parameters['siret'];
        $entreprise->pays =  $parameters['pays'];
        $entreprise->ville =  $parameters['ville'];
        $entreprise->telephone =  $parameters['telephone'];
        $entreprise->save();
        if (Auth::check()) {
            return view('admin.operation.create');
        }
    }


    public function addlecteurs(Request $request)
    {
        $parameters = $request->all();
        $operation = Operation::findOrFail($parameters['operation']);
       // dd($parameters);
        foreach($parameters['lecteurs'] as $lecteur)
        {
            $user = User::findOrFail($lecteur);
            $user->operations()->attach($operation);

        }
        return back();
    }


    public function addoperateurs(Request $request)
    {
        $parameters = $request->all();
        $operation = Operation::findOrFail($parameters['operation']);
        foreach($parameters['operateurs'] as $operateur)
        {
            $user = User::findOrFail($operateur);
            $user->operations()->attach($operation);

        }
        return back();
    }

    public function removelecteur($id,$id1){

          $user = User::findOrFail($id);
          $operation = Operation::findOrFail($id1);
          $operation->users()->detach($user);
          return response()->json('true');
    }

    public function removeoperateur($id,$id1){

        $user = User::findOrFail($id);
        $operation = Operation::findOrFail($id1);
        $operation->users()->detach($user);
        return response()->json('true');
  }

    public function listLecteurs($id)
    {
        $operation = Operation::with('users')->findOrFail($id);
        $selected_lecteurs = $operation->users;
        $lecteurs = User::where('role', '0')->get();

        $opusers = [];

        foreach($lecteurs as $lecteur)
        {
            $opuser = new OpUsers();
            $opuser = $lecteur;
            $opuser->status = false;
            foreach($selected_lecteurs as $selected)
            {
                if($selected->id === $lecteur->id )
                {
                    $opuser->status = true;
                break;
                }
            }
            $opusers[] = $opuser;
        }
        return response()->json($opusers);
    }

    public function listOperateurs($id)
    {
        $operation = Operation::with('users')->findOrFail($id);
        $selected_operateur = $operation->users;
        $operateurs = User::where('role', '1')->get();
        $opusers = [];
        foreach($operateurs as $operateur)
        {
            $opuser = new OpUsers();
            $opuser = $operateur;
            $opuser->status = false;
            foreach($selected_operateur as $selected)
            {
                if($selected->id === $operateur->id )
                {
                    $opuser->status = true;
                break;
                }
            }
            $opusers[] = $opuser;
        }
        return response()->json($opusers);
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

        $form = new Form([
            'title' => ucfirst($parameters['nom_formulaire']),
            'description' => ucfirst($parameters['description_formulaire']),
            'status' => Form::STATUS_DRAFT,
            'user_id' => auth()->user()->id,

        ]);
        $form->generateCode();
        $form->save();
        $form_id = $form->id;

        $formavalide = new FormAvailability();
        $formavalide->form_id = $form_id ;
        $formavalide->open_form_at  = $parameters['date_debut'];
        $formavalide->close_form_at = $parameters['date_fin'];
        $formavalide->closed_form_message = "Formulaire clos";
        $formavalide->save();

        $operation = new Operation();
        $operation->nom = $parameters['nom_operation'];
        $operation->form_id = $form_id;
        $operation->date_start = $parameters['date_debut'];
        $operation->date_end = $parameters['date_fin'];
        $operation->user_id = Auth::user()->id;
        $operation->save();

        return redirect()->route('operation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operation = Operation::with('users')->findOrFail($id);
        return view('admin.operation.show',compact('operation'));
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
