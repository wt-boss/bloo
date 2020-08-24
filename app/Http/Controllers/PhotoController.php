<?php

namespace App\Http\Controllers;

use App\Piece;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * PhotoController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function envoi()
    {
        return view('photo');
    }

    public function envoipost(Request $request)
    {
        $piece = Piece::create($request->all());
        return response()->json($piece);
    }
}
