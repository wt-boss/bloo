<?php

namespace App\Http\Controllers;


use App\Questionnaire;
use Illuminate\Http\Request;


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
