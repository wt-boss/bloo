<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getHome(){
        return view('pages.home');
    }
    public function getServices(){
        return view('pages.services');
    }
    public function getSondage(){
        return view('pages.sondages');
    }
    public function getPrix(){
        return view('pages.prix');
    }

}
