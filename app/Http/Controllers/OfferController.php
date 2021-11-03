<?php

namespace App\Http\Controllers;
use App\Extra;
use App\Offer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index(){
        $offers=Offer::all();
        $extras=Extra::all();
        return view('admin.offers.index',compact('offers','extras'));
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
        return redirect()->route('offers.index')->withSuccess('Modification Effectuée');
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
        return redirect()->route('offers.index')->withSuccess('Modification Effectuée');

    }

}
