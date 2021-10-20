<?php

namespace App\Http\Controllers;
use App\Extra;
use App\Offer;

use Illuminate\Http\Request;

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
        return redirect()->route('offers.index')->withSuccess('Modification Effectuée');
    }
    public function destroy(){

    }

}
