<?php

namespace App\Http\Controllers;

use AkibTanjim\Currency\Currency;
use App\Abonnement;
use App\Entreprise;
use App\Extra;
use App\Facture;
use App\Form;
use App\FormAvailability;
use App\Http\Requests\OffreRequest;
use App\Offer;
use App\Offre;
use App\Operation;
use App\Operation_user;
use App\Paiement;
use App\Subscription;
use App\Token;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
use phpDocumentor\Reflection\Types\Array_;
use Redirect;
use Session;
use URL;

class PaymentController extends Controller
{
    /**
     * @param OffreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payWithpaypal(OffreRequest $request)
    {

        $data = $request->except('_token');
        // Creation de l'user
        $user = new User();
        $user->first_name = $data["first_name"];
        $user->last_name = $data["last_name"];
        $user->email = $data["user_email"];
        $user->password = $data["password"];
        $user->api_token = Str::random(80);
        $user->role = 4;
        $user->phone = $data["telephone"];
        $user->country_id = $data["country_id"];
        $user->state_id = $data["state_id"];
        $user->city_id = $data["city_id"];
        $user->active = 1;
        $user->email_token = Str::random(64);
        $user->save();
        $user->sendEmailVerificationNotification();

        //Creation de l'entreprise
        if($data["name_enterprise"] !== null)
        {
            $entreprise = new Entreprise();
            $entreprise->nom = $data["name_enterprise"];
            $entreprise->adresse = $data["address_enterprise"];
            $entreprise->contribuable = $data["contribuanle_enterprise"];
            $entreprise->siret = $data["siret_enterprise"];
            $entreprise->type = "Personne Morale";
            $entreprise->telephone =  $data["telephone_entreprise"];
            $entreprise->save();
            $entreprise->users()->attach($user);
        }

         //souscription au forfait
        $subscription = new Subscription();
        $subscription->user_id = $user->id;
        if($data['mode'] === 'illimité'){
                $subscription->offer_id = 2;
                $subscription->state='demo';
        }else{
                $subscription->offer_id = 1;
                $subscription->state='paid';
        }
        $subscription->state='demo';
        $subscription->date=date('Y-m-d H:i:s');
        $subscription->save();
        $this->make_bill($subscription);

        return view('successoffre');
    }

    /**
     * @param $subscription
     */
    public function make_bill($subscription){
        $facture = new Facture();
        $json=[];
        $offer=Offer::findOrFail($subscription->offer_id);
        $json['subscription_id']=$subscription->id;
        $json['offer_id']=$subscription->offer_id;
        $json['offer_price']=$offer->montant;
        $json['date']=Carbon::now();
        $facture->description="Achat ".$offer->intitule;
        $facture->subscriptions_id=$subscription->id;
        $facture->date=Carbon::now();
        $facture->Total=$offer->montant;
        $facture->info_json=json_encode($json);
        $facture->save();
    }

}
