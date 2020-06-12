<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;

class SurveyController extends Controller
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
