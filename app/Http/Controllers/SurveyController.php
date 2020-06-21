<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;

class SurveyController extends Controller
{
    public function store(Questionnaire $questionnaire)
    {
        $data = request()->all();
        $survey = $questionnaire->surveys()->create($data['survey']);

        for ($i=0;$i<=100;$i++ )
        {

            if(isset($data['responses'][$i]))
           {
               $survey->responses()->create($data['responses'][$i]);

           }

            if(isset($data['responsest'][$i]))
            {
                if($data['responsest'][$i]['answer'] !== NULL)
                {
                    $survey->responses()->create($data['responsest'][$i]);
                }
                echo '<br><br>';
            }

            if(isset($data['responsesm'][$i]))
            {
                $g = $data['responsesm'][$i];
                $p = 0;
                while(isset($g[$p]))
                {
                    if(array_key_exists("answer_id", $g[$p])){
                        $survey->responses()->create($g[$p]);
                    }
                    $p++;
                }
            }
        }
        if($questionnaire->active === 0)
        {
            return redirect('/questionnaire/create/validate/'.$questionnaire->slug.'#questions')->withSuccess('réponses test enregistrées avec success');
        }
        else
            {
                return redirect('/home');
            }
    }
    public function primus(){
        return view('offres.primus');
    }
    public function illimité(){
        return view('offres.illimité');
    }
}
