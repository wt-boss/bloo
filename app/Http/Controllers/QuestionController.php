<?php

namespace App\Http\Controllers;

use App\Question;
use App\Questionnaire;
use App\Survey_response;
use App\User;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class QuestionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Questionnaire $questionnaire)
    {
         $data = request()->all();
         $question = $questionnaire->questions()->create($data['questions']);
         if(($data['questions']['question_type']) === "checkbox" || ($data['questions']['question_type']) ==="radio" )
         {
             $question->answers()->createMany($data['answers']);
         }
        return redirect('/questionnaire/create/validate/'.$questionnaire->slug.'#questions')->withSuccess('Question creer avec success');
    }

    public function destroy(Questionnaire $questionnaire,Question $question)
    {
        $question->answers()->delete();
        $question->delete();
        return back()->withSuccess('Question et réponses associees suprimés avec success');
    }

    public function answer_destroy(Questionnaire $questionnaire)
    {
         $questions = $questionnaire->questions()->get();
         foreach ($questions as $question)
         {
             Survey_response::where('question_id','=',$question->id)->delete();
         }
        return redirect('/questionnaire/create/validate/'.$questionnaire->slug.'#questions')->withSuccess('réponses test suprimés avec success');
    }

}
