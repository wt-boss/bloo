<?php

namespace App\Http\Controllers;

use App\Country;
use App\Questionnaire;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;

class SurveyController extends Controller
{

    public function signup(){
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
        return view('offres.signup',compact('countries'));
    }

    public function primus(){
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
        return view('offres.primus',compact('countries'));
    }
    public function illimité(){
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
        return view('offres.illimité',compact('countries'));
    }
}
