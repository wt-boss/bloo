<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Form;
use App\Location;
use App\Operation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\FormResponse;
use App\FieldResponse;
use App\Exports\FormResponseExport;
use Maatwebsite\Excel\Facades\Excel;

class ResponceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->guard = "api";
    }


    // public function store(Request $request)
    // {
    //     $test = "You are a genius";
    //     $user = auth()->user();
    //     $aime = $test.$user;
    //     return response()->json($aime);
    // }

    public function store(Request $request, $form)
    {
        $user = auth()->user();
        $pusher = App::make('pusher');
        $data = ['from' => 1, 'to' => 2]; // sending from and to user id when pressed enter
        $pusher->trigger('responce-channel', 'my-event', $data);
        if ($request->ajax()) {
            $form = Form::where('code', $form)->first();
            $data = $request->all();
            $operation = Operation::where('form_id',$form->id)->get()->first();

            //On verfie si c'est un sondage gratuit ou payant
            if(!empty($operation))
            {
                //Sauvegarde de la position de l'operateur
                $location = new Location([
                    'user_id' =>  $user->id,
                    'site_id' => isset($data['site_id']) ? $data['site_id'] : 0,
                    'operation_id' => $operation->id ,
                    'lat' => str_replace(',', '.', $data['lat']),
                    'lng'=> str_replace(',', '.', $data['lng'])
                ]);
                $location->save();
            }


            if (!$form || $form->status !== Form::STATUS_OPEN) {
                return response()->json([
                    'success' => false,
                    'error_message' => 'not_allowed',
                    'error' => (!$form) ? 'Form is invalid' : 'Form is not accessible',
                ]);
            }

            $form_fields = $form->fields()->filled()->select(['id', 'attribute', 'required'])->get();
            $inputs = [];
            $validation_rules = [];
            $validation_messages = [];

            foreach ($form_fields as $field) {
                $attribute = str_replace('.', '_', $field->attribute);
                $input_data = [
                    'question' => $field->question,
                    'value' => Arr::get($request->all(), $attribute),
                    'required' => $field->required,
                    'options' => $field->options,
                    'template' => str_replace('-', '_', $field->template)
                ];

                $inputs[$attribute] = $input_data;
            }

            foreach ($inputs as $attribute => $input) {
                $rule = ($input['required']) ? 'required|' : 'nullable|';
                $messages = ($input['required']) ? ['required' => 'All questions with * are required'] : [];

                switch ($input['template']) {
                    case 'short_answer':
                        $rule .= 'string|min:3|max:255';
                        $messages['min'] = "Answer to: \"{$input['question']}\" must be at least 3 characters";
                        $messages['max'] = "Answer to: \"{$input['question']}\" must not be greater than 255 characters";;
                        break;
                    case 'long_answer':
                        $rule .= 'string|min_words:3|max:60000';
                        $message['min_words'] = "Answer to: \"{$input['question']}\" must be at least 3 words long";
                        $message['max'] = "Answer to: \"{$input['question']}\" must not be greater than :max characters";
                        break;
                    case 'checkboxes':
                        //For check box array
                        $validation_rules[$attribute] = "{$rule}max:" . count($input['options']);
                        $checkbox_message = ['max' => "Selected Option(s) to: \"{$input['question']}\" is invalid"];
                        $validation_messages[$attribute] = array_merge($messages, $checkbox_message);

                        //For individual value
                        $rule .= 'string|in:'. implode(',', $input['options']);
                        $messages['in'] = "Selected Option(s) to: \"{$input['question']}\" is invalid";
                        break;
                    case 'multiple_choices':
                    case 'drop_down':
                        $rule .= 'string|in:'. implode(',', $input['options']);
                        $messages['in'] = "Selected Option to: \"{$input['question']}\" is invalid";
                        break;
                    case 'date':
                        $rule .= 'string|date';
                        $messages['date'] = "Answer to: \"{$input['question']}\" is not a valid date";
                        break;
                    case 'time':
                        $rule .= 'string|date_format:H:i';
                        $messages['date_format'] = "Answer to: \"{$input['question']}\" is not a valid time";
                        break;
                    case 'linear_scale':
                        $rule .= "integer|between:{$input['options']['min']['value']},{$input['options']['max']['value']}";
                        $messages['between'] = "Answer to: \"{$input['question']}\" is invalid";
                        break;
                }

                $new_attribute = ($input['template'] === 'checkboxes') ? "{$attribute}.*" : $attribute;
                $validation_rules[$new_attribute] = $rule;
                $validation_messages[$new_attribute] = $messages;
            }

            $validator = \Validator::make($request->except('_token'), $validation_rules, Arr::dot($validation_messages));

            if ($validator->fails()) {
                $errors = collect($validator->errors())->flatten();
                return response()->json([
                    'success' => false,
                    'error_message' => 'validation_failed',
                    'error' =>  $errors->first()
                ]);
            }

            $response = new FormResponse([
                'respondent_ip' => (string) $request->ip(),
                'respondent_user_agent' => (string) $request->header('user-agent'),
                'respondent_id' => $user->id
            ]);

            $response->generateResponseCode();
            $form->responses()->save($response);

            foreach ($form_fields as $field) {
                $attribute = str_replace('.', '_', $field->attribute);
                $value = $request->input($attribute);

                $field_response = new FieldResponse([
                    'form_response_id' => $response->id,
                    'answer' => is_array($value) ? json_encode($value) : $value,
                ]);

                $field->responses()->save($field_response);
            }

            return response()->json([
                'success' => true,
            ]);
        }
    }

}
