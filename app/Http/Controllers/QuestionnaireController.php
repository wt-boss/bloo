<?php

namespace App\Http\Controllers;


use App\Questionnaire;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class QuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        auth()->user()->questionnaires()->create($data);
        return redirect('/home')->withSuccess('Questionnaire créer avec sucess');
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
        $token = Hash::make($type);
        $data['token'] = $token;
        $questionnaire = Questionnaire::create($data);

        return view('questionnaire.validate',compact('questionnaire'));
    }

     public function active(Questionnaire $questionnaire)
     {
         $questionnaire['active'] = 0;
         $questionnaire->save();
         return redirect('questionnaire.resume_free')->withSuccess('Questionnaires activé avec success');
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
                 return view('questionnaire.show_free',compact('questionnaire'));
             }
             else{
                 return back()->withErrors('mot de passe incorect');
             }
         }
         else{
             return back()->withErrors('token incorect');
         }

     }

    public function valid(Questionnaire $questionnaire)
    {
        $data = request()->all();
        $data['password'] = Hash::make($data['password']);
        $questionnaire->update($data);
        $questionnaire->load('questions.answers.responses');
        return view('questionnaire.show_free',compact('questionnaire'));
    }

    public function view(Questionnaire $questionnaire)
    {
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
    public function edit(Questionnaire $questionnaire)
    {
        return view('questionnaire.edit',compact('questionnaire'));
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
