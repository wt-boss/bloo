<?php

namespace App\Http\Controllers;

use App\Form;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TemplateController extends Controller
{

    public function alltemplates(Request $request)
    {
        $topic_id = $request->input('topic_id');
        $templates = Template::with('form')->where('topic_id', $topic_id)->get();
        $viewData = (string)View::make('Helpers.template', compact('templates'));
        return response()->json($viewData);

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
