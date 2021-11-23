<?php

namespace App\Http\Controllers;
use App\Extra;
use App\ExtraSubscription;
use App\Offer;

use App\Promotion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index(){
        $offers=Offer::all();
        $extras=Extra::with('offer')->get();
        $promotion=Promotion::with('offer')->get();
        $users = ExtraSubscription::where('suscriber_id',auth()->user()->id)
            ->join("extras","extra_subscription.extra_id","extras.id")
            ->join("users","extra_subscription.user_id","users.id")
            ->get();
        return view('admin.offers.index',compact('offers','extras','promotion','users'));
    }
    public function create(){
        return view('offers.create');
    }
    public function store(Request $request){
        $offer=Request::all();
        $offer->save();
    }
    public function edit($id){
        $offer=Offer::findOrFail($id);
        return view('admin.offers.edit',compact('offer'));
    }
    public function update(Request $request,$id){
        $offer=Offer::findOrFail($id);
        $offer->update($request->all());
        $this->change_offer($offer);
        return redirect()->route('offers.index')->withSuccess(trans("Modification Done"));
    }
    public function destroy(){

    }
    public function change_offer($offer){
        $date_chg=date("Y-m-d h:i:s");
        $ended_date=strtotime($date_chg."+100 years");
        $ended_date=date("Y-m-d h:i:s",$ended_date);
        $record=DB::table('offer_changes')->where('offer_id',$offer->id)->latest();
        if($record){
            $record->update(['ended_date'=>$date_chg]);
        }
        DB::table('offer_changes')->insert(['offer_id'=>$offer->id,'montant'=>$offer->montant,'date_chg'=>$date_chg,'ended_date'=>$ended_date]);
        return redirect()->route('offers.index')->withSuccess(trans("Modification Done"));

    }

}
