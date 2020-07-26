<?php

namespace App\Http\Controllers;

use App\Entreprise;
use App\Operation_user;
use Illuminate\Support\Facades\Validator;
use App\FormAvailability;
use App\Form;
use App\Operation;
use App\OpUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
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
        $entreprises = Entreprise::all();
        return view('admin.operation.create',compact('entreprises'));
    }

    public function entreprise()
    {
        $entreprises = Entreprise::all();
        return view('admin.operation.entreprise',compact('entreprises'));
    }

    public function saventreprise(Request $request)
    {
        $parameters = $request->all();
        $entreprise = new Entreprise();
        $entreprise->nom = $parameters['nom'];
        $entreprise->addrese = $parameters['adresse'];
        $entreprise->Numero_contribuable =  $parameters['contribuable'];
        $entreprise->numero_siret =  $parameters['siret'];
        $entreprise->pays =  $parameters['pays'];
        $entreprise->ville =  $parameters['ville'];
        $entreprise->type =  "Personne Morale";
        $entreprise->telephone =  $parameters['telephone'];
        $entreprise->save();
        $user = User::findOrFail(Auth::user()->id);
        $entreprise->users()->attach($user);
        if (Auth::check()) {
            return view('admin.operation.create',compact('entreprise'));
        }
        else
        {
            return redirect()->route('home');
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

    public function listLecteurs(Request $request)
    {
        $operation_id = $request->input('operation_id');
        $operation = Operation::with('users')->findOrFail($operation_id);
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

    public function listOperateurs(Request $request)
    {
        $operation_id = $request->input('operation_id');
        $operation = Operation::with('users')->findOrFail($operation_id);
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
        $operation->entreprise_id = $parameters['entreprise_id'];
        $operation->save();

        $user = User::findOrFail(Auth::user()->id);
        $operation->users()->attach($user);

        return redirect()->route('operation.index');
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
        $operation = Operation::findOrFail($id);
        $entreprise_id = $operation->entreprise_id;
        $entreprise = Entreprise::findOrFail($entreprise_id);
        return view('admin.operation.edit',compact('operation','entreprise'));
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

        $parameters = $request->all();
        $operation = Operation::findOrFail($id);
        $operation->nom = $parameters['nom_operation'];
        $operation->form_id =  $parameters['form_id'];
        $operation->date_start = $parameters['date_debut'];
        $operation->date_end = $parameters['date_fin'];
        $operation->entreprise_id = $parameters['entreprise_id'];
        $operation->save();

        $form_id = $parameters['form_id'];

        $form = Form::findOrFail($form_id);
        $form->title = ucfirst($parameters['nom_formulaire']);
        $form->description = ucfirst($parameters['description_formulaire']);
        $form->save();

        return redirect()->route('operation.index')->withSuccess('Modification Effectuée');
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
