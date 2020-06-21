<?php

namespace App\Http\Controllers;

use AkibTanjim\Currency\Currency;
use App\Entreprise;
use App\Offre;
use App\Opération;
use App\Paiement;
use App\User;
use Illuminate\Http\Request;
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
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function rates(){
        $response = Currency::getRates();
        return response()->json($response);
    }

    public function payWithpaypal(Request $request)
    {
        $donées = $request->except('_token');
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('status' ) ) /** Specify return URL **/
        ->setCancelUrl(URL::to('status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        /** Creation de l'utilisateur,de l'entreprise,de l'operation et du paiement **/

        /** Création de l'utilisateur */

        /** Si on a affaire a une entreprise alors création de l'utilisateur */
        if($donées["options"] === "ENTREPRISE")
        {
            $user = new User();
            $user->name = $donées["user_name_entreprise"];
            $user->email = $donées["user_email_entreprise"];
            $user->password = Hash::make($donées["user_password_entreprise"]);
            $user->api_token = Str::random(80);
            $user->role = 0;
            $user->active = 1;
            $user->save();
            $user_id = $user->id;

            $entreprise = new Entreprise();
            $entreprise->user_id = $user_id;
            $entreprise->nom = $donées["name_enterprise"];
            $entreprise->addrese = $donées["address_enterprise"];
            $entreprise->Numero_contribuable = $donées["contribuanle_enterprise"];
            $entreprise->numero_siret = $donées["siret_enterprise"];
            $entreprise->pays = $donées["pays_entreprise"];
            $entreprise->ville = $donées["ville_entreprise"];
            $entreprise->telephone =  $donées["telephone_entreprise"];
            $entreprise->save();
        }
        else{
            $user = new User();
            $user->name = $donées["user_name"];
            $user->email = $donées["user_email"];
            $user->password = Hash::make($donées["user_password"]);
            $user->api_token = Str::random(80);
            $user->role = 0;
            $user->active = 1;
            $user->save();
            $user_id = $user->id;
        }
        /** Si l'offre choisi est primus alors, creation d'une operation */
        if($donées['amount'] == "3466.22" )
        {
            $operation = new Opération();
            $operation->user_id = $user_id;
            $operation->nom = $donées["operation_name"];
            $operation->description = $donées["operation_purpose"];
            $operation->date_start =$donées["date_start"];
            $operation->date_end = $donées["date_end"];
            $operation->save();
        }
        /** Recherche de l'offre choisi**/
       //$offre_id = Offre::where('montant','=',$donées['amount'])->pluck('id')->get()->first();
        /** Création du paiement **/
        $paiement = new Paiement();
        $paiement->paiement_id = $payment->getId();
        $paiement->user_id = $user_id;
        $paiement->save();
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
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
