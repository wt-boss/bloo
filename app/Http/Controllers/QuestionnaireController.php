<?php

namespace App\Http\Controllers;


use App\Questionnaire;
use Carbon\Carbon;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class QuestionnaireController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Renvoie a la page de connection pour la creation d'un formulaire gratuit
     *
     * @return \Illuminate\Http\Response
     */
    public function free()
    {
        return view('questionnaire.free');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questionnaire.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $date = Carbon::now()->toDateTimeString();
        $type = $data['title'].$data['purpose'].$date;
        $token = base64_encode($type);
        $data['slug'] = $token;
        auth()->user()->questionnaires()->create($data);
        return redirect('/home')->withSuccess('Questionnaire créer avec sucess');
    }

    public function confirm($slug)
    {
        $questionnaire = Questionnaire::where('slug',$slug)->get()->first();
        $questionnaire['active'] = 1;
        $questionnaire->save();
        return view('questionnaire.confirm',compact('questionnaire'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_free(Request $request)
    {
        $data = $request->all();
        $date = Carbon::now()->toDateTimeString();
        $type = $data['title'].$data['purpose'].$date;
        $slug = base64_encode($type);
        $token = Hash::make($type);
        $data['token'] = $token;
        $data['slug'] = $slug;
        $questionnaire = Questionnaire::create($data);
        return view('questionnaire.show_free',compact('questionnaire'));
    }

     public function active(Questionnaire $questionnaire)
     {
         $questionnaire['active'] = 1;
         $questionnaire->save();
         return back()->withSuccess('Questionnaires activé avec success');
     }

     public function login_free(){
        return view('questionnaire.login_free');
     }
     public function identify_free(Request $request)
     {
         $data = $request->all();
         $questionnaire = Questionnaire::where('token', '=', $request->token)
             ->where('token','=',$request->token)->get()->first();
         if(isset($questionnaire))
         {
             if( Hash::check($request->password,$questionnaire->password))
             {
                 return redirect(url('/questionnaire/create/validate/'.$questionnaire->slug));
             }
             else{
                 return back()->withErrors('mot de passe incorect');
             }
         }
         else{
             return back()->withErrors('token incorect');
         }
     }

    public function valid($slug)
    {
        $data = request()->all();
        $questionnaire = Questionnaire::where('slug',$slug)->get()->first();
        $data['password'] = Hash::make($data['password']);
        $questionnaire->update($data);
        $questionnaire->load('questions.answers.responses');
        return view('questionnaire.show_free',compact('questionnaire'));
    }

    public function view($slug)
    {
        $questionnaire = Questionnaire::where('slug',$slug)->get()->first();
        $questionnaire->load('questions.answers');
        return view('questionnaire.view',compact('questionnaire'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions.answers.responses');
        return view('questionnaire.show',compact('questionnaire'));
    }

    public function show_free($slug)
    {
        $questionnaire = Questionnaire::where('slug',$slug)->get()->first();
        $questionnaire->load('questions.answers.responses');
        return view('questionnaire.show_free',compact('questionnaire'));
    }


    public function stats(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions.answers.responses');
        return view('questionnaire.stats',compact('questionnaire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $questionnaire = Questionnaire::where('slug',$slug)->get()->first();
        $start = date('Y-m-d', strtotime($questionnaire->date_start));
        $end = date('Y-m-d', strtotime($questionnaire->date_end));
        return view('questionnaire.edit',compact('questionnaire','start','end'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update($id)
     {
      $data = request()->all();
      $questionnaire = Questionnaire::findOrFail($id);
      $questionnaire->update($data);
      return redirect('/home')->withSuccess('Questionnaires mis a jour avec success');
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire)
    {
        $questionnaire->questions()->delete();
        $questionnaire->delete();
        return redirect('home')->withSuccess('Questionnaires,questions et réponses associees suprimés avec success');
    }
}
