<?php

namespace App\Http\Controllers;

use App\Country;
use App\Entreprise;
use App\Facture;
use App\Operation;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class FactureController extends Controller
{
    public function index(){
        $facture=Facture::all();
        $user = auth()->user();
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
        $diagram =  collect();
        $diagram->push(['Client','Operation']);
        if($user->role === 5)
        {
            $comptes = Entreprise::with('operations')->get();
            foreach ($comptes as $compte)
            {
                $operations = $compte->operations()->count();
                $table = [$compte->nom,$operations];
                $diagram->push($table);
            }
            $operations = Operation::all();
            $operateurs = User::where('role','1')->get();
            $lecteurs = User::where('role','0')->get();
            $rapports = Operation::where('status','TERMINER')->get();
        }
        else{
            $comptes = $user->entreprises()->get();
            $operations = collect(); //Toutes les operations de l'utilisateurs connecté.
            $operateurs = collect(); //Tout les operateurs des operations.
            $lecteurs = collect(); //Tous les lecteurs des operations.
            $rapports = collect();
            foreach ($comptes as $entreprise)
            {
                $countoperations = $entreprise->operations()->count();
                $table = [$entreprise->nom,$countoperations];
                $diagram->push($table);

            }
            $User = User::with('operations')->findOrFail($user->id);
            $operations = $User->operations()->with('form','entreprise')->get();
            foreach ($operations as $operation)
            {
                $AllUsers = $operation->users()->get();
                foreach ($AllUsers as $User)
                {
                    if($User->role === 1)
                    {
                        $operateurs->push($User);
                    }
                    else if ($User->role === 0)
                    {
                        $lecteurs->push($User);
                    }
                }
            }
        }
        $factures = Facture::select('*')->join('subscriptions','subscriptions.id','=','factures.subscriptions_id')->where('subscriptions.user_id',auth()->user()->id)->get();
        return view('admin.facture.index',compact('factures','comptes','lecteurs','operateurs','operations','rapports'));
    }

    public function create(){

        $facture=Facture::select('factures.*')->join('subscriptions','subscriptions.id','=','factures.subscription_id');
        dd($facture);
        return view('admin.facture.index',compact('facture'));
    }

    public function store(){
        $facture=Facture::all();
        return view('admin.facture',compact('facture'));
    }

    public function edit(){
        $facture=Facture::all();
        return view('admin.facture',compact('facture'));
    }

    public function update(){
        $facture=Facture::all();
        return view('admin.facture',compact('facture'));
    }

    public function destroy(){
        $facture=Facture::all();
        return view('admin.facture',compact('facture'));
    }

    public function showfaacture($subscription) {

        $Subscription = Subscription::findOrFail($subscription);

        $facture = Facture::where(['subscriptions_id' => $Subscription->id])->get()->last();

        Stripe::setApiKey('sk_test_51Gs1ssFp9ycafSINcR9Lxf56buVrRyIPWYfT7OaOCXLanB5tH83cata9evl95MRKkrm2HYsziNW67PXcXKGyAbCq00FYjps0tu');

        $intent = PaymentIntent::create([
            'amount' => $facture->Total,
            'currency' => 'usd',
        ]);

        $clientSecret = Arr::get($intent, 'client_secret');


        return view('admin.facture.facture',compact('facture','clientSecret'));
    }

    public function payement(Request $request)
    {
        $facture_id = $request->input('facture_id');
        $template = Facture::findOrFail($facture_id);
        $subscription =  Subscription::findOrFail($template->subscriptions_id);
        $subscription->state = "paid";
        $subscription->save();
        return response()->json(['success' => true],200);
    }
}
