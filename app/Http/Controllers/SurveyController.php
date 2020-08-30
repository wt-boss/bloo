<?php

namespace App\Http\Controllers;

use App\Country;
use App\Questionnaire;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;

class SurveyController extends Controller
{

    public function primus(){
        $countries  = Country::where('name','Cameroon')
            ->orwhere('name','Central African Republic')
            ->orwhere('name','Congo')
            ->orwhere('name','Gabon')
            ->orwhere('name','Equatorial Guinea')
            ->orwhere('name','Chad')
            ->orwhere('name','Nigeria')
            ->orwhere('name','Angola')
            ->orwhere('name','Congo The Democratic Republic Of The')
            ->get();
        return view('offres.primus',compact('countries'));
    }
    public function illimité(){
        $countries  = Country::where('name','Cameroon')
            ->orwhere('name','Central African Republic')
            ->orwhere('name','Congo')
            ->orwhere('name','Gabon')
            ->orwhere('name','Equatorial Guinea')
            ->orwhere('name','Chad')
            ->orwhere('name','Nigeria')
            ->orwhere('name','Angola')
            ->orwhere('name','Congo The Democratic Republic Of The')
            ->get();
        return view('offres.illimité',compact('countries'));
    }
}
