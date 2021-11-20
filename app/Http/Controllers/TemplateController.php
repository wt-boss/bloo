<?php

namespace App\Http\Controllers;

use App\Form;
use App\FormAvailability;
use App\FormField;
use App\Operation;
use App\Operation_User;
use App\Template;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TemplateController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function alltemplates(Request $request)
    {
        $topic_id = $request->input('topic_id');
        $templates = Template::with('form')->where('topic_id', $topic_id)->get();
        $viewData = (string)View::make('Helpers.template', compact('templates'));
        return response()->json($viewData);

    }


    public function use($id){
        /**
         * Retrouver les template et l'operation
         */
        $template = Template::findOrFail($id);
        $theform = Form::with('fields')->findOrFail($template->form_id);
        $thelast = Operation_User::where('user_id', auth()->user()->id)->get()->last();
        $operation = Operation::findOrFail($thelast->operation_id);

        /**
         * Creation du fomrulaire;
         */
        $form = new Form([
            'title' => $theform->title,
            'description' => $theform->description,
            'status' => $theform->status,
            'user_id' => auth()->user()->id,
        ]);
        $form->generateCode();
        $form->save();
        $form_id = $form->id;

        /**
         * Enregistremnt des questions;
         */
        foreach($theform->fields as $item) {
            $field = new FormField([
                'template' => $item->template,
                'attribute' => $item->attribute,
                'question' => $item->question,
                'required' => $item->required,
                'options' => $item->options,
                'filled' =>$item->filled
            ]);
            $form->fields()->save($field);
        }

        /**
         * Mise a jour de l'operation
         */
        $operation->form_id = $form->id;
        $operation->save();

        /**
         * Mise a jour des paramettre de disponobilité
         */
        $formavalide = new FormAvailability();
        $formavalide->form_id = $form_id;
        $formavalide->open_form_at = $operation->date_debut;
        $formavalide->close_form_at = $operation->date_fin;
        $formavalide->closed_form_message = "Formulaire non ouvert au reponse";
        $formavalide->save();

        return redirect()->route('operation.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        return view('admin.templates.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_user = Auth::user();

        $form = new Form([
            'title' => ucfirst($request->name),
            'description' => ucfirst($request->description),
            'status' => Form::STATUS_DRAFT
        ]);

        $form->generateCode();

        $form->generatePassword();

        $current_user->forms()->save($form);

        $template = new Template([
            'form_id' => $form->id ,
            'topic_id' => $request->topic_id
        ]);

        $template->save();
        return redirect()->route('topics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}
