<?php

namespace App\Http\Controllers;

use App\AdminClient;
use App\City;
use App\Entreprise;
use App\Extra;
use App\Facture;
use App\Location;
use App\Mail\BlooLecteur;
use App\Mail\BlooOperateur;
use App\Notifications\EventNotification;
use App\Notifications\MessageRated;
use App\Offer;
use App\Operation_user_save;
use App\State;
use App\Subscription;
use App\Token;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        $tokens = null;

        if ($user->role === 6) {
            $operations = Operation::with('form', 'entreprise')->orderBy('id','DESC')->get();
        } else if ($user->role === 4) {
            $User = User::with('operations')->findOrFail($user->id);
            $operations = $User->operations()->with('form', 'entreprise')->orderBy('id','DESC')->get();
        } else {
            $User = User::with('operations')->findOrFail($user->id);
            $operations = $User->operations()->with('form', 'entreprise')->orderBy('id','DESC')->get();
        }

        return view('admin.operation.index', compact('operations', 'operation','tokens'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entreprises = Entreprise::all();
        return view('admin.operation.create', compact('entreprises'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function entreprise()
    {
        $entreprises = Entreprise::all();
        $countries  = Country::where('id','38')
            ->orwhere('id','42')
            ->orwhere('id','50')
            ->orwhere('id','79')
            ->orwhere('id','67')
            ->orwhere('id','43')
            ->orwhere('id','161')
            ->orwhere('id','7')
            ->orwhere('id','51')
            ->get();

        if(auth()->user()->role === "6")
        {
            return view('admin.operation.entreprise', compact('entreprises', 'countries'));
        }
        else
        {
            return  redirect()->route('operation.create');
        }

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
            return view('admin.operation.create', compact('entreprise'));
        } else {
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

        $message = "Vous avez été ajouter à l'operration : " . $operation->nom;
        foreach ($parameters['lecteurs'] as $lecteur) {
            $user = User::findOrFail($lecteur);
            $user->operations()->attach($operation);
            Mail::to($user->email)->send(new BlooLecteur());
            $user->notify(new EventNotification($message));
            $pusher = App::make('pusher');
            $data = ['ajout lecteur']; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel', 'notification-event', $data);

        }
        return back();
    }

    /**
     * @param $operateur
     * @param $operation
     */

    private function addoperateursprocess($operateur,$operation){

        $user = User::findOrFail($operateur);
        $user->operations()->attach($operation);
        $savedata =  new Operation_user_save();
        $savedata->user_id = $user->id;
        $savedata->operation_id = $operation->id;
        $savedata->save();

        /** Envoie de notification a l'application moblie */
        $notification_id = $user->device_token;
        $title = trans("Operation")." ".$operation->nom;
        $message = trans("You have been added as an operator to this operation");
        $id = $user->id;
        $type = "basic";
        $res = send_notification_FCM($notification_id, $title, $message, $id,$type);
        /** Mail aux operateurs **/
        Mail::to($user->email)->send(new BlooOperateur());
        $user->notify(new EventNotification($message));

        $pusher = App::make('pusher');
        $data = ['from' => 1, 'to' => 2]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'notification-event', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addoperateurs(Request $request)
    {
        $Auth = auth()->user();
        $parameters = $request->all();
        $operation = Operation::findOrFail($parameters['operation']);
        $message = "Vous avez été ajouter à l'operration : " . $operation->nom;
        foreach ($parameters['lecteurs']as $operateur) {
            if($Auth->payg === 1 )
            {
                $tokens = Token::where('user_id',$Auth->id)->get()->first();
                $count = $tokens->own;
                if($count > 0)
                {
                    $this->addoperateursprocess($operateur, $operation);
                    --$tokens->own;
                    ++$tokens->gift;
                    $tokens->save();
                }
            }
            else
            {
                $this->addoperateursprocess($operateur, $operation);
            }

        }
        return back();
    }

    /**
     * @param $id
     * @param $id1
     * @return \Illuminate\Http\JsonResponse
     */
    public function removelecteur($id, $id1)
    {

        $user = User::findOrFail($id);
        $operation = Operation::findOrFail($id1);
        $message = "Vous avez été retiré de l'operation : " . $operation->nom;
        $operation->users()->detach($user);
        $user->notify(new EventNotification($message));
        $pusher = App::make('pusher');
        $data = ['from' => 1, 'to' => 2]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'notification-event', $data);
        return response()->json('true');
    }

    /**
     * @param $id
     * @param $id1
     */
    private function removeoperateurprocess($id,$id1)
    {
        $user = User::findOrFail($id);
        $operation = Operation::findOrFail($id1);
        $operation->users()->detach($user);
        $message = $operation->nom." ". trans("You have been removed as an operator from this operation");
        $user->notify(new EventNotification($message));

        /** Envoie de notification a l'application moblie */
        $notification_id = $user->device_token;
        $title = trans("Operation")." ".$operation->nom;
        $message = trans("You have been removed as an operator from this operation");
        $id = $user->id;
        $type = "basic";
        $res = send_notification_FCM($notification_id, $title, $message, $id,$type);
        $pusher = App::make('pusher');
        $data = ['moving and operator']; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'notification-event', $data);
    }

    /**
     * @param $id
     * @param $id1
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeoperateur($id, $id1)
    {
        $Auth = auth()->user();
        if($Auth->payg === 1 )
        {
            $tokens = Token::where('user_id',$Auth->id)->get()->first();
            $this->removeoperateurprocess($id,$id1);
            ++$tokens->own;
            --$tokens->gift;
            $tokens->save();
        }
        else
        {
            $this->removeoperateurprocess($id,$id1);
        }
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
        foreach ($lecteurs as $lecteur) {
            $opuser = new OpUsers();
            $opuser = $lecteur;

            foreach ($selected_lecteurs as $selected) {
                if ($selected->id === $lecteur->id) {
                    $opuser->status = "disabled";
                    break;
                }
            }
            $opusers[] = $opuser;
        }
        //$viewData = Helper::buildUsersTable($opusers);
        $viewData = (string)View::make('Helpers.BuildUsersTable', compact('opusers','operation'));
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
        $form = $operation->form;
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
        foreach ($AllOperation as $Operation) {
            $AllUser = $Operation->users()->where('role', '1')->get();
            foreach ($AllUser as $User) {
                $AllOperateur->push($User);
            }
        }
        $selected_operateur = $operation->users;
        $operateurs = User::with('country','state')->where('role', '1')->get();
        $opusers = [];
        foreach ($operateurs as $operateur) {
            $opuser = new OpUsers();
            $opuser = $operateur;
            $opuser->status = false;
            foreach ($AllOperateur as $selected) {
                if ($selected->id === $operateur->id) {
                    $opuser->status = "disabled";
                    break;
                }
            }
            $opusers[] = $opuser;
        }
        $viewData = (string)View::make('Helpers.BuildOperateursList', compact('opusers','operation'));
//        $viewData = Helper::buildUsersTable($opusers);
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
        $users = $operation->users()->where('role', '0')->get();
        //$viewData = Helper::buildUsersList($users);
        $viewData = (string)View::make('Helpers.BuildUsersList', compact('users'));
        return response()->json($viewData);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getoperationAdmins(Request $request)
    {
        $users = User::where('role', '5')->get();
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
        $users = $operation->users()->where('role', '1')->get();
        //$viewData = Helper::buildUsersList($users);
        $viewData = (string)View::make('Helpers.BuildUsersList', compact('users'));
        return response()->json($viewData);
    }

    public function getOperateursTable($id)
    {
        $Auth = auth()->user();
        $tokens = null;
        $viewData = null;
        $operation = Operation::findOrFail($id);
        if($Auth->payg === 1)
        {
            $tokens = Token::where('user_id',$Auth->id)->get()->first();
            $viewData = (string)View::make('Helpers.BuildUserToken', compact('tokens'));
        }
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
        foreach ($AllUsers as $user) {
            if ($user->role === 4) {
                $users->push($user);
            }
        }
        // $viewData = Helper::buildUsersList($users);
        $viewData = (string)View::make('Helpers.BuildUsersList', compact('users'));
        return response()->json($viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parameters = $request->all();

        /*
         * Creation de l'operation
         * */
        $operation = new Operation();
        $operation->nom = $parameters['nom_operation'];
        $operation->form_id = 0;
        $operation->date_start = $parameters['date_debut'];
        $operation->date_end = $parameters['date_fin'];
        if(auth()->user()->hasRole('Superadmin|Admin')){
          $operation->entreprise_id = $parameters['entreprise_id'];
        }
        $operation->save();


        $user = User::findOrFail(Auth::user()->id);
        $operation->users()->attach($user);
        $pusher = App::make('pusher');
        $data = "Une operation a été créer";
        $pusher->trigger('my-channel', 'operation-event', $data);

        return redirect()->route('templates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $tokens = null;
        if(auth()->user()->payg === 1 )
        {
            $tokens = Token::where('user_id',auth()->user()->id)->get()->last();
        }
        $Villes = collect();
        $operation = Operation::with('entreprise','sites')->findOrFail($id);
        $sites = $operation->sites()->get()->GroupBy('ville');
        foreach ($sites as $site => $value)
        {
            $Villes->push($site);
        }
        $current_user = Auth::user();
        $form = $operation->form;
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
            if (!empty($response_for_chart)) {
                $data_for_chart[] = $response_for_chart;
            }
        }

        $data_for_chart2 = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChart2();
            if (!empty($response_for_chart)) {
                $data_for_chart2[] = $response_for_chart;
            }
        }

        $view = (string)View::make('admin.operation.partials.response', compact('operation', 'form', 'responses'));
        $viewprint = (string)View::make('admin.operation.partials.responseprint', compact('operation', 'form','responses'));
        $viewoperateurs = (string)View::make('admin.operation.partials.responseoperateur', compact('operation'));




        if ($request->ajax()) {
            return [
                'response_view' => $view,
                'data_for_chart' => json_encode($data_for_chart),
                'response_view2' => $viewprint,
                'data_for_chart2' => json_encode($data_for_chart2),
                'response_operateurs' => $viewoperateurs,
                'tokens' => $tokens
            ];
        } else {
            return view('admin.operation.show', compact('view','viewprint', 'operation', 'form', 'query', 'responses', 'data_for_chart','data_for_chart2','Villes','tokens'));
        }
    }

    public function pdf($id, Request $request)
    {
        $operation = Operation::with('entreprise')->findOrFail($id);
        $current_user = Auth::user();
        $form = $operation->form;
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
            if (!empty($response_for_chart)) {
                $data_for_chart[] = $response_for_chart;
            }
        }


        $data_for_chart2 = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChart2();
            if (!empty($response_for_chart)) {
                $data_for_chart2[] = $response_for_chart;
            }
        }

        $view = (string)View::make('admin.operation.partials.response', compact('operation', 'form', 'query', 'responses'));
        $viewprint = (string)View::make('admin.operation.partials.responseprint', compact('operation', 'form', 'query', 'responses'));

        if ($request->ajax()) {
            return [
                'response_view' => $view,
                'data_for_chart' => json_encode($data_for_chart),
                'data_for_chart2' => json_encode($data_for_chart2)
            ];
        } else {
            return view('admin.operation.pdf', compact('view', 'viewprint', 'operation', 'form', 'query', 'responses', 'data_for_chart', 'data_for_chart2'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operation = Operation::findOrFail($id);
        //$entreprise_id = $operation->entreprise_id;
        //$entreprise = Entreprise::findOrFail($entreprise_id);
        return view('admin.operation.edit', compact('operation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $parameters = $request->all();
        $operation = Operation::findOrFail($id);
        $operation->nom = $parameters['nom_operation'];
        $operation->form_id = $parameters['form_id'];
        $operation->date_start = $parameters['date_debut'];
        $operation->date_end = $parameters['date_fin'];
        $operation->entreprise_id = $parameters['entreprise_id'];
        $operation->save();
        $form_id = $parameters['form_id'];
        $form = Form::findOrFail($form_id);
        $form->title = ucfirst($parameters['nom_formulaire']);
        $form->description = ucfirst($parameters['description_formulaire']);
        $form->save();

        return redirect()->route('operation.index')->withSuccess(trans("Modification Done"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
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
        $operation = Operation::with('sites')->findOrFail($id);
        $sites = $operation->sites()->get();
        return view('admin.operation.map', compact('sites', 'operation'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function operationsites2($id)
    {
        $operation = Operation::with('sites')->findOrFail($id);
        $sites = $operation->sites()->get();
        return response()->json($sites);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function terminer_operation($id)
    {
        $operation = Operation::findOrFail($id);
        $message = "l'operration : " . $operation->nom . " est terminé.";

        $AllOpUser = $operation->users()->get();
        foreach ($AllOpUser as $user) {
            $user->notify(new EventNotification($message));
            $pusher = App::make('pusher');
            $data = ['clossing an operation']; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel', 'notification-event', $data);
        }

        $AllUser = $operation->users()->where('role', '1')->get();
        foreach ($AllUser as $User) {
            /** Envoie de notification a l'application moblie */
            $notification_id = $User->device_token;
            $title = trans("Operataion").$operation->nom;
            $message = trans("Operataion").": ".$operation->nom." ".trans("has just ended");
            $id = $User->id;
            $type = "basic";
            $res = send_notification_FCM($notification_id, $title, $message, $id,$type);
//            if($res == 1){
//
//                // success code
//
//            }else{
//
//                // fail code
//            }
            $operation->users()->detach($User);
        }
        $operation->status = "TERMINER";
        $operation->save();

        $form = Form::findOrFail($operation->form_id);
        $form->status = Form::STATUS_CLOSED;
        $form->save();


        return back()->withSuccess(trans('Fin_operation'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function debuter_operation($id)
    {
        $operation = Operation::with('form')->findOrFail($id);
        $message = "l'operration : " . $operation->nom . " a debuté.";
        $AllOpUser = $operation->users()->where('role', '1')->where('role', '0')->get();
        $form = $operation->form()->get()->last();
        $form->status = "open";
        foreach ($AllOpUser as $user) {
            $user->notify(new EventNotification($message));
            $pusher = App::make('pusher');
            $data = ['clossing an operation']; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel', 'notification-event', $data);
        }

        $AllUser = $operation->users()->where('role', '1')->get();
        foreach ($AllUser as $User) {
            /** Envoie de notification a l'application moblie */
            $notification_id = $User->device_token;
            $title = trans("Operation")." ".$operation->nom." ";
            $message = trans("Operation").": ".$operation->nom." ".trans("to start");
            $id = $User->id;
            $type = "basic";
            $res = send_notification_FCM($notification_id, $title, $message, $id,$type);
//            if($res == 1){
//
//                // success code
//
//            }else{
//
//                // fail code
//            }
            $operation->users()->detach($User);
        }
        $operation->status = "EN COUR";
        $form->save();
        $operation->save();
        return back()->withSuccess(trans('Debut_operation'));
    }

    public function activation($id)
    {
        $user = User::findOrFail($id);
        $user->active = 1;
        Mail::to($user->email)->send(new BlooOperateur());
        $user->save();
        return back()->withSuccess('Opérateur activé');
    }

    /**
     * @param $id
     * @param $paysid
     * @return array
     */
    public function TryPays($id, $paysid)
    {
        $operation = Operation::with('entreprise')->findOrFail($id);
        $country = Country::findOrFail($paysid);
        $current_user = Auth::user();
        $form = $operation->form;

        $responses = [];
        $form->load('fields.responses', 'collaborationUsers', 'availability');

        $pays = Country::findOrFail($paysid);

        $data_for_chart = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChartPays($paysid);
            if (!empty($response_for_chart)) {
                $data_for_chart[] = $response_for_chart;
            }
        }

        $data_for_chart2 = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChartPays2($paysid);
            if (!empty($response_for_chart)) {
                $data_for_chart2[] = $response_for_chart;
            }
        }




        $view = (string)View::make('admin.operation.partials.responsescountry', compact('operation', 'form', 'responses','paysid'));
        $viewprint = (string)View::make('admin.operation.partials.responsescountryprint', compact('operation', 'form','responses','paysid','pays'));

        return [
            'response_view' => $view,
            'response_view2' => $viewprint,
            'data_for_chart' => json_encode($data_for_chart),
            'data_for_chart2' => json_encode($data_for_chart2)
        ];
    }

    /**
     * @param $id
     * @param $siteid
     * @return array
     */

    public function TrySites($id, $siteid)
    {
        $operation = Operation::with('entreprise')->findOrFail($id);

        $form = $operation->form;

        $site = Site::findOrFail($siteid);

        $responses = [];
        $form->load('fields.responses', 'collaborationUsers', 'availability');

        $data_for_chart = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChartSite($siteid);
            if (!empty($response_for_chart)) {
                $data_for_chart[] = $response_for_chart;
            }
        }

        $data_for_chart2 = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChartSite2($siteid);
            if (!empty($response_for_chart)) {
                $data_for_chart2[] = $response_for_chart;
            }
        }

        $view = (string)View::make('admin.operation.partials.responsesite', compact('operation', 'form', 'responses','siteid'));
        $viewprint = (string)View::make('admin.operation.partials.responsesiteprint', compact('operation', 'form', 'responses','siteid','site'));

        return [
            'response_view' => $view,
            'response_view2' => $viewprint,
            'data_for_chart' => json_encode($data_for_chart),
            'data_for_chart2' => json_encode($data_for_chart2)
        ];
    }

    public function TryVilles($id, $ville)
    {

        $operation = Operation::with('entreprise')->findOrFail($id);

        $form = $operation->form;

        $responses = [];
        $form->load('fields.responses', 'collaborationUsers', 'availability');

        $data_for_chart = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChartVille($ville);
            if (!empty($response_for_chart)) {
                $data_for_chart[] = $response_for_chart;
            }

        }

        $data_for_chart2 = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChartVille2($ville);
            if (!empty($response_for_chart)) {
                $data_for_chart2[] = $response_for_chart;
            }

        }

        $view = (string)View::make('admin.operation.partials.responseville', compact('operation', 'form', 'responses','ville'));
        $viewprint = (string)View::make('admin.operation.partials.responsevilleprint', compact('operation', 'form', 'responses','ville'));

        return [
            'response_view' => $view,
            'response_view2' => $viewprint,
            'data_for_chart' => json_encode($data_for_chart),
            'data_for_chart2' => json_encode($data_for_chart2)
        ];
    }

    public function TryUsers($id, $userid)
    {

        $operation = Operation::with('entreprise')->findOrFail($id);

        $form = $operation->form;

        $responses = [];
        $form->load('fields.responses', 'collaborationUsers', 'availability');

        $data_for_chart = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChartUser($userid);
            if (!empty($response_for_chart)) {
                $data_for_chart[] = $response_for_chart;
            }

        }

        $data_for_chart2 = [];
        $fields = $form->fields;
        foreach ($fields as $field) {
            $response_for_chart = $field->getResponseSummaryDataForChartUser2($userid);
            if (!empty($response_for_chart)) {
                $data_for_chart2[] = $response_for_chart;
            }

        }

        $view = (string)View::make('admin.operation.partials.responseuser', compact('operation', 'form', 'responses','userid'));
        $viewprint = (string)View::make('admin.operation.partials.responseuserprint', compact('operation', 'form', 'responses','userid'));

        return [
            'response_view' => $view,
            'response_view2' => $viewprint,
            'data_for_chart' => json_encode($data_for_chart),
            'data_for_chart2' => json_encode($data_for_chart2)
        ];
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSites($id)
    {
        $operation = Operation::with('sites')->findOrFail($id);
        return response()->json($operation->sites()->get());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVilles($id)
    {

        $operation = Operation::with('cities')->findOrFail($id);
        return response()->json($operation->cities->unique('id'));
    }

    public function tryOperateurs($id)
    {
        $operation = Operation::findOrFail($id);
        $users = $operation->users()->where('role', '1')->get();
        return response()->json($users);
    }

    public function AllLocation($operationid,$userid)
    {
        $locations = Location::where('operation_id',$operationid)->where('user_id',$userid)->get();
        return response()->json($locations);
    }


    public function VueAllLocation($userid,$operationid)
    {
        return view('admin.operation.localisation',compact('userid','operationid'));
    }

    /**
     *
     */
    public function listAdmin()
    {
        $users = User::where('role','5')->get();
        return response()->json($users);
    }


    public function list_extra(Request $request){
        $user=Auth::user();
        $subscription=$user->subscriptions()->first();
        $extra=$subscription->extras()->get();
        dd($extra);
        return response()->json($extra);
        // return view('admin.extras.index',compact('extra'));
    }

    public function add_extra(Request $request){

        return view('admin.extras.add');
        #return redirect(route('extra.list'))->withSuccess('Extra ajouté avec sucess');

    }
    public function update_extra(Request $request){
        $extra=Extra::findOrFail($request->extra_id);
        $extra->cost= $request->montant;
        $extra->save();
        $this->change_extra($extra);
        return redirect()->route('offers.index')->withSuccess(trans("Modification Done"));
        #return redirect(route('extra.list'))->withSuccess('Extra ajouté avec sucess');

    }

    public function store_extra(Request $request){
        $this->validate($request, User::rules());
        User::create(request()->all());
        $extra_user=User::OrderBy('id','desc')->first();
        $user=Auth::user();
        $subscription=$user->subscriptions()->first(); //TODO en principe on doit creer une souscription s'il n'y en a pas
        $extra=Extra::where('type','=',$extra_user->rolename())->where('offer_id',$request->offer_id)->get()->last();
        $subscription->extras()->attach($extra,['suscriber_id'=>$user->id,'user_id'=>$extra_user->id,'active'=>0]);
        $facture=new Facture();
        $json=[];
        $date=Carbon::now();
        $offer=Offer::findOrFail($subscription->offer_id);
        $json['subscription_id']=$subscription->id;
        $json['offer_id']=$subscription->offer_id;
        $json['offer_price']=$offer->montant;
        $json['extra-'.$date.'-name']=$extra->type;
        $json['extra-'.$date.'-cost']=$extra->cost;
        $json['date']=Carbon::now();
        $facture->description="Achat ".$extra->type;
        $facture->subscriptions_id=$subscription->id;
        $facture->date=$date;
        $facture->Total=$extra->cost;
        $facture->info_json=json_encode($json);
        $facture->save();
        return back()->withSuccess('Extra créer avec sucess');
        //return redirect(route('offers.list'))->withSuccess('Extra créer avec sucess');
    }

    public function remove_extra($id){

    }

    public function disable_extra($id){
        DB::table('extra_subscriptions')->where('subscription_id','=',$id)->update(['active'=>0]);
    }

    public function enable_extra($id){
        DB::table('extra_subscriptions')->where('subscription_id','=',$id)->update(['active'=>1]);
    }

    public function set_admin($client_id,$admin_id){
        $admin=User::findOrfail($admin_id);
        $client=User::findOrfail($client_id);
        $admin->admins()->attach($client);
    }

    public function unset_admin($client_id,$admin_id){
        $admin=User::findOrfail($admin_id);
        $client=User::findOrfail($client_id);
        $admin->admins()->detach($client);
    }

    public function change_extra($extra){
        $date_chg=date("Y-m-d h:i:s");
        $ended_date=strtotime($date_chg."+100 years");
        $ended_date=date("Y-m-d h:i:s",$ended_date);
        $record=DB::table('extra_changes')->where('extra_id',$extra->id)->latest();
        if($record){
            $record->update(['ended_date'=>$date_chg]);
        }
        DB::table('extra_changes')->insert(['extra_id'=>$extra->id,'montant'=>$extra->cost,'date_chg'=>$date_chg,'ended_date'=>$ended_date]);
        return redirect()->route('offers.index')->withSuccess(trans("Modification Done"));
    }

    public function change_offer($offer){
        $date_chg=date("Y-m-d h:i:s");
        $ended_date=strtotime($date_chg."+100 years");
        $ended_date=date("Y-m-d h:i:s",$ended_date);
        $record=DB::table('offer_changes')->where('offer_id',$offer->id)->latest();
        if($record){
            $record->update(['ended_date'=>$date_chg]);
        }
        // DB::table('offer_changes')->where('extra_id',$offer->id)->first()->update(['ended_date'=>$date_chg]);
        DB::table('offer_changes')->insert(['offer_id'=>$offer->id,'montant'=>$offer->cost,'date_chg'=>$date_chg,'ended_date'=>$ended_date]);
        return redirect()->route('offers.index')->withSuccess(trans("Modification Done"));
        #return redirect(route('extra.list'))->withSuccess('Extra ajouté avec sucess');

    }

    public function retrieve_father($id){
        $user=User::findOrFail($id);
        $father_id=DB::table('extra_subscription')->where('extra_id',$user->id)->first();
        $father=User::findOrFail($father_id);
        return response()->json($father);
    }


    public function retrieve_children_list($id){
        $father=User::findOrFail($id);
        $children=DB::table('extra_subscription')->where('suscriber_id',$father->id)->get();
        return response()->json($children);
    }

}
