<?php

namespace App\Http\Controllers\Form;

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
use Illuminate\Http\Request;
use App\Exports\FormResponseExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ResponseController extends Controller
{
    public function index(Form $form)
    {
        $current_user = Auth::user();

        $valid_request_queries = ['summary', 'individual'];

        $query = strtolower(request()->query('type', 'summary'));

        abort_if(!in_array($query, $valid_request_queries), 404);

        if ($query === 'summary') {
            $responses = [];
            $form->load('fields.responses', 'collaborationUsers', 'availability');
        } else {
            $form->load('collaborationUsers');

            $responses = $form->responses()->has('fieldResponses')->with('fieldResponses.formField')->paginate(1, ['*'], 'response');
        }

        return view('forms.response.index', compact('form', 'query', 'responses'));
    }

    public function store(Request $request, $form)
    {
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
                    'user_id' =>  Auth::check() ? Auth::user()->id : 0,
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
                'respondent_id' =>(string) Auth::check() ? Auth::user()->id : ''
            ]);

            $response->generateResponseCode();
            $form->responses()->save($response);

            foreach ($form_fields as $field) {
                $attribute = str_replace('.', '_', $field->attribute);
                $value = $request->input($attribute);

                $field_response = new FieldResponse([
                    'form_response_id' => $response->id,
                    'answer' => is_array($value) ? json_encode($value) : $value
                ]);

                $field->responses()->save($field_response);
            }

            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function export(Form $form)
    {
        $current_user = Auth::user();
        $filename = Str::slug($form->title) . '.Xlsx';
        return Excel::download(new FormResponseExport($form), $filename);
    }

    public function destroy(Form $form, FormResponse $response)
    {
        $current_user = Auth::user();
        $user_not_allowed = ($form->user_id !== $current_user->id && !$current_user->isFormCollaborator($form->id));
        $not_allowed = ($user_not_allowed || $form->id !== $response->form_id);
        abort_if($not_allowed, 403);

        $response->delete();

        session()->flash('index', [
            'status' => 'success', 'message' => 'Response has been deleted successfully.'
        ]);

        return redirect()->route('forms.responses.index', [$form->code, 'type' => 'individual']);
    }

    public function destroyAll(Form $form)
    {
        $current_user = Auth::user();
        $not_allowed = ($form->user_id !== $current_user->id && !$current_user->isFormCollaborator($form->id));
        abort_if($not_allowed, 403);

        $responses = $form->responses()->get();
        abort_if(!$form->has('responses')->exists(), 403);

        $form->responses()->chunk(100, function ($responses) {
            foreach ($responses as $response) {
                $response->delete();
            }
        });

        session()->flash('index', [
            'status' => 'success', 'message' => 'All Responses for this form have been deleted successfully'
        ]);

        return redirect()->route('forms.responses.index', $form->code);
    }
}
