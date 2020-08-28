<?php

namespace App\Http\Controllers;

use App\Entreprise;
use App\Notifications\EventNotification;
use App\Notifications\MessageRated;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Operation_user;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use App\FormAvailability;
use App\Form;
use App\Operation;
use App\OpUsers;
use App\User;
use App\Country;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;

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
        $user = auth()->user();
        $operation = null;

        if($user->role === 5)
        {
             $operations = Operation::with('form','entreprise')->get();
        }
         else if ($user->role === 4){
             $comptes = $user->entreprises()->get();
             $operations = collect(); //Toutes les operations de l'utilisateurs connecté.
             foreach ($comptes as $entreprise)
             {
                 $Operations = $entreprise->operations()->get();
               foreach ($Operations as $operation)
               {
                   $operations->push($operation);
               }
             }
         }
         else
         {
             $User = User::with('operations')->findOrFail($user->id);
             $operations = $User->operations()->with('form','entreprise')->get();
         }
        return view('admin.operation.index',compact('operations','operation'));
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function entreprise()
    {
        $entreprises = Entreprise::all();
        $countries  = Country::where('name','Cameroon')
            ->orwhere('name','Central African Republic')
            ->orwhere('name','Congo')
            ->orwhere('name','Gabon')
            ->orwhere('name','Equatorial Guinea')
            ->orwhere('name','Chad')
            ->orwhere('name','Nigeria')
            ->orwhere('name','Angola')
            ->get();
        return view('admin.operation.entreprise',compact('entreprises', 'countries'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function saventreprise(Request $request)
    {
        $entreprise = Entreprise::create($request->all());
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addlecteurs(Request $request)
    {
        $parameters = $request->all();

        $operation = Operation::findOrFail($parameters['operation']);
        $message = "Vous avez été ajouter à l'operration : ".$operation->nom;
        foreach($parameters['lecteurs'] as $lecteur)
        {
            $user = User::findOrFail($lecteur);
            $user->operations()->attach($operation);
            $user->notify(new EventNotification($message));
            $pusher = App::make('pusher');
            $data = ['ajout lecteur']; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel','notification-event', $data);

        }
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addoperateurs(Request $request)
    {

        $parameters = $request->all();
        $operation = Operation::findOrFail($parameters['operation']);
        $message = "Vous avez été ajouter à l'operration : ".$operation->nom;
        foreach($parameters['operateurs'] as $operateur)
        {
            $user = User::findOrFail($operateur);
            $user->operations()->attach($operation);
            $user->notify(new EventNotification($message));
            $pusher = App::make('pusher');
            $data = ['from' => 1, 'to' => 2]; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel','notification-event', $data);
        }
        return back();
    }

    /**
     * @param $id
     * @param $id1
     * @return \Illuminate\Http\JsonResponse
     */
    public function removelecteur($id,$id1){

        $user = User::findOrFail($id);
        $operation = Operation::findOrFail($id1);
        $message = "Vous avez été retier de l'operration : ".$operation->nom;
        $operation->users()->detach($user);
        $user->notify(new EventNotification($message));
        $pusher = App::make('pusher');
        $data = ['from' => 1, 'to' => 2]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel','notification-event', $data);
        return response()->json('true');
    }

    /**
     * @param $id
     * @param $id1
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeoperateur($id,$id1){

        $user = User::findOrFail($id);
        $operation = Operation::findOrFail($id1);
        $operation->users()->detach($user);
        $message = "Vous avez été retirer de l'operration : ".$operation->nom;
        $user->notify(new EventNotification($message));
        $pusher = App::make('pusher');
        $data = ['moving and operator']; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel','notification-event', $data);
        return response()->json('true');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
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

            foreach($selected_lecteurs as $selected)
            {
                if($selected->id === $lecteur->id )
                {
                    $opuser->status = "disabled";
                    break;
                }
            }
            $opusers[] = $opuser;
        }
        $viewData = Helper::buildUsersTable($opusers);
        return response()->json($viewData);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function testresponses($id)
    {
        $operation = Operation::with('entreprise')->findOrFail($id);
        $current_user = Auth::user();
        $form=$operation->form;
        $valid_request_queries = ['summary', 'individual'];
        $query = strtolower(request()->query('type', 'summary'));
        $viewData = Helper::showformresponse($form);
        return response()->json($operation);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function listOperateurs($id)
    {
        $operation = Operation::with('users')->findOrFail($id);
        $AllOperation = Operation::with('users')->get();
        $AllOperateur = collect();
        foreach ($AllOperation as $Operation)
        {
            $AllUser = $Operation->users()->where('role','1')->get();
            foreach ($AllUser as $User)
            {
                $AllOperateur->push($User);
            }
        }
        $selected_operateur = $operation->users;
        $operateurs = User::where('role', '1')->get();
        $opusers = [];
        foreach($operateurs as $operateur)
        {
            $opuser = new OpUsers();
            $opuser = $operateur;
            $opuser->status = false;
            foreach($AllOperateur as $selected)
            {
                if($selected->id === $operateur->id )
                {
                    $opuser->status = "disabled";
                    break;
                }
            }
            $opusers[] = $opuser;
        }
        $viewData = Helper::buildUsersTable($opusers);
        return response()->json($viewData);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getoperationLecteurs(Request $request)
    {
        $operation_id = $request->input('operation_id');
        $operation = Operation::findOrFail($operation_id);
        $users = $operation->users()->where('role','0')->get();
        $viewData = Helper::buildUsersList($users);
        return response()->json($viewData);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getoperationOperateurs(Request $request)
    {
        $operation_id = $request->input('operation_id');
        $operation = Operation::findOrFail($operation_id);
        $users = $operation->users()->where('role','1')->get();
        $viewData = Helper::buildUsersList($users);
        return response()->json($viewData);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getoperationManager(Request $request)
    {
        $users = collect();
        $operation_id = $request->input('operation_id');
        $operation = Operation::findOrFail($operation_id);
        $entreprise = $operation->entreprise()->get()->last();
        $AllUsers = $entreprise->users()->get();
        /**
         * On recherche l'acount Manager de cette operation;
         */
        foreach ($AllUsers as $user)
        {
            if ($user->role === 4)
            {
                $users->push($user);
            }
        }
        $viewData = Helper::buildUsersList($users);
        return response()->json($viewData);
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
        $pusher = App::make('pusher');
        $data = "Une operation a été créer" ;
        $pusher->trigger('my-channel', 'my-event', $data);
        return redirect()->route('operation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $operation = Operation::with('entreprise')->findOrFail($id);
        $current_user = Auth::user();
        $form=$operation->form;
        $valid_request_queries = ['summary', 'individual'];
        $query = strtolower(request()->query('type', 'summary'));

        abort_if(!in_array($query, $valid_request_queries), 404);

        if ($query === 'summary') {
            $responses = [];
            $form->load('fields.responses', 'collaborationUsers', 'availability');
        } else {
            $form->load('collaborationUsers');

            $responses = $form->responses()->has('fieldResponses')->with('fieldResponses.formField')->paginate(1, ['*'], 'response');
        }

        $data_for_chart = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChart();
            if(!empty($response_for_chart)) {
                $data_for_chart[] = $response_for_chart;
            }
        }


        $data_for_chart2 = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChart2();
            if(!empty($response_for_chart)) {
                $data_for_chart2[] = $response_for_chart;
            }
        }

        $view = (string)View::make('admin.operation.partials.response',compact('operation','form', 'query', 'responses'));
        $viewprint = (string)View::make('admin.operation.partials.responseprint',compact('operation','form', 'query', 'responses'));

        if($request->ajax()){
            return [
                'response_view' => $view,
                'data_for_chart' => json_encode($data_for_chart),
                'data_for_chart2' => json_encode($data_for_chart2)
            ];
        } else {
            return view('admin.operation.show',compact('view','viewprint','operation','form', 'query', 'responses', 'data_for_chart','data_for_chart2'));
        }
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

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function operationsites($id)
    {
        $sites = Site::orderby('id','desc')->get();
        $operation = Operation::findOrFail($id);
        return view('admin.operation.map',compact('sites','operation'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function terminer_operation($id)
    {
        $operation = Operation::findOrFail($id);
        $message = "l'operration : ".$operation->nom." est terminé.";
        $AllUser = $operation->users()->where('role','1')->get();
        foreach ($AllUser as $User)
        {
            $operation->users()->detach($User);
        }

        $AllOpUser = $operation->users()->where('role','1')->where('role','0')->get();
        foreach ($AllOpUser as $user)
        {
            $user->notify(new EventNotification($message));
            $pusher = App::make('pusher');
            $data = ['clossing an operation']; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel','notification-event', $data);
        }
        $operation->status = "TERMINER";
        $operation->save();
        return back()->withSuccess(trans('Fin_operation'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function debuter_operation($id)
    {
        $operation = Operation::with('form')->findOrFail($id);
        $message = "l'operration : ".$operation->nom." a debuté.";
        $AllOpUser = $operation->users()->where('role','1')->where('role','0')->get();
        $form = $operation->form()->get()->last();
        $form->status = "open";
        foreach ($AllOpUser as $user)
        {
            $user->notify(new EventNotification($message));
            $pusher = App::make('pusher');
            $data = ['clossing an operation']; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel','notification-event', $data);
        }
        $operation->status = "EN COUR";
        $form->save();
        $operation->save();
        return back()->withSuccess(trans('Debut_operation'));
    }
}
