<?php

namespace App\Http\Controllers;
use App\Offer;

use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(){
        $offers=Offer::all();
        return view('admin.offers.index',compact('offers'));
    }
    public function create(){
        return view('offers.create');
    }
    public function store(Request $request){
        $offer=Request::all();
        $offer->save();
    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }

}
