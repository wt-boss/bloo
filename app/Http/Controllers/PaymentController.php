<?php

namespace App\Http\Controllers;

use AkibTanjim\Currency\Currency;
use App\Entreprise;
use App\Form;
use App\FormAvailability;
use App\Offre;
use App\Operation;
use App\Operation_user;
use App\Paiement;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use Illuminate\Support\Facades\Input;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        // $paypal_conf = \Config::get('paypal');
        // $this->_api_context = new ApiContext(new OAuthTokenCredential(
        //         $paypal_conf['client_id'],
        //         $paypal_conf['secret'])
        // );
        // $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function rates(){
        $response = Currency::getRates();
        return response()->json($response);
    }

    public function payWithpaypal(Request $request)
    {
        $parameters = $request->all();

        if($parameters['user_password'] != $parameters['user_conf_password'])
        {
           return back()->withErrors("Veillez confirmer votre mot de passe.");
        }
        if($parameters['user_password_entreprise'] != $parameters['user_conf_password_entreprise'])
        {
            return back()->withErrors("Veillez confirmer votre mot de passe.");
        }

        $data = $request->except('_token');

        // $payer = new Payer();
        // $payer->setPaymentMethod('paypal');
        // $item_1 = new Item();
        // $item_1->setName('Item 1') /** item name **/
        // ->setCurrency('USD')
        //     ->setQuantity(1)
        //     ->setPrice($request->get('amount')); /** unit price **/
        // $item_list = new ItemList();
        // $item_list->setItems(array($item_1));
        // $amount = new Amount();
        // $amount->setCurrency('USD')
        //     ->setTotal($request->get('amount'));

        // $transaction = new Transaction();
        // $transaction->setAmount($amount)
        //     ->setItemList($item_list)
        //     ->setDescription('Your transaction description');
        // $redirect_urls = new RedirectUrls();
        // $redirect_urls->setReturnUrl(route('status' ) ) /** Specify return URL **/
        // ->setCancelUrl(URL::to('status'));

        // $payment = new Payment();
        // $payment->setIntent('Sale')
        //     ->setPayer($payer)
        //     ->setRedirectUrls($redirect_urls)
        //     ->setTransactions(array($transaction));
        // /** dd($payment->create($this->_api_context));exit; **/
        // try {
        //     $payment->create($this->_api_context);
        // } catch (\PayPal\Exception\PPConnectionException $ex) {
        //     if (\Config::get('app.debug')) {
        //         \Session::put('error', 'Connection timeout');
        //         return Redirect::to('/');
        //     } else {
        //         \Session::put('error', 'Some error occur, sorry for inconvenient');
        //         return Redirect::to('/');
        //     }
        // }
        // foreach ($payment->getLinks() as $link) {
        //     if ($link->getRel() == 'approval_url') {
        //         $redirect_url = $link->getHref();
        //         break;
        //     }
        // }
        // /** add payment ID to session **/
        // Session::put('paypal_payment_id', $payment->getId());

        // Creation du user et entreprise
        $user = new User();
        $entreprise = new Entreprise();
        /** Creation de l'utilisateur,de l'entreprise,de l'operation et du paiement **/
        if (User::where('email', $data["user_email"])->exists()|| User::where('email', $data["user_email_entreprise"])->exists()) {
            return back()->withErrors('Un compte avec cette adressse email existes deja');
        }
        else
        {
            /** Edition de l'utilisateur */
            if($data["options"] === "ENTREPRISE")
            {
                $user->first_name = $data["user_name_entreprise"];
                $user->last_name = '';
                $user->email = $data["user_email_entreprise"];
                $user->password = $data["user_password_entreprise"];
            }
            else{
                $user->first_name = $data["user_name"];
                $user->last_name = '';
                $user->email = $data["user_email"];
                $user->password = $data["user_password"];
            }

            $user->api_token = Str::random(80);
            $user->role = 0;
            $user->active = 1;
            // $user->save();
            // $user_id = $user->id;
        }

        if($data["options"] === "ENTREPRISE")
        {
            $entreprise->nom = $data["name_enterprise"];
            $entreprise->adresse = $data["address_enterprise"];
            $entreprise->contribuable = $data["contribuanle_enterprise"];
            $entreprise->siret = $data["siret_enterprise"];
            $entreprise->type = "Personne Morale";
            $entreprise->city_id = $data["city_id"];
            $entreprise->telephone =  $data["telephone_entreprise"];
            $entreprise->email =  $data["email_entreprise"];
        }
        else{
            $entreprise->nom = $data["user_name"];
            $entreprise->type = "Personne Physique";
            $entreprise->email =   $data["user_email"];
            $entreprise->city_id = '19169' ;
        }

        $entreprise->save();
        $user->save();
        $entreprise->users()->attach($user);

        /** Si l'offre choisi est primus alors, creation d'une operation */
        if($data['amount'] == "3466.22" )
        {
            $form = new Form([
                'title' => ucfirst($data["operation_name"]),
                'description' => ucfirst($data["operation_purpose"]),
                'status' => Form::STATUS_DRAFT,
                'user_id' => "1",
            ]);
            $form->generateCode();
            $form->save();
            $form_id = $form->id;

            $formavalide = new FormAvailability();
            $formavalide->form_id = $form_id ;
            $formavalide->open_form_at  = $data["date_start"];
            $formavalide->close_form_at = $data["date_end"];
            $formavalide->closed_form_message = "Formulaire clos";
            $formavalide->save();

            $operation = new Operation();
            $operation->nom = $data['operation_name'];
            $operation->form_id = $form_id;
            $operation->date_start =$data["date_start"];
            $operation->date_end = $data["date_end"];
            $operation->entreprise_id = $entreprise->id;
            // $operation->user_id = "1";
            $operation->save();
            // $id = "1";
            // $user = User::findOrFail($id);
            $user = User::get()->first();
            // $user_lect =  User::findOrFail($user_id);
            $operation->users()->attach($user);
            // $operation->users()->attach($user_lect);

        }
        /** Recherche de l'offre choisi**/
       //$offre_id = Offre::where('montant','=',$data['amount'])->pluck('id')->get()->first();
        /** Création du paiement **/
        // $paiement = new Paiement();
        // $paiement->paiement_id = $payment->getId();
        // $paiement->user_id = $user_id;
        // $paiement->save();
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/')->withSuccess("Compte créé avec succès.");
    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty((new \Illuminate\Http\Request)->input('PayerID')) || empty((new \Illuminate\Http\Request)->input('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::to('/');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {

            \Session::put('success', 'Payment success');
            return Redirect::to('/');
        }
        \Session::put('error', 'Payment failed');
        return Redirect::to('/');
    }
}
