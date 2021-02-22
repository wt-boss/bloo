<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index($locale){
        App::setlocale($locale);
        $cookie = cookie('lang_blooapp', $locale, 525600);
        session()->put('locale', $locale);
        return redirect()->back()->cookie($cookie);
    }
}
