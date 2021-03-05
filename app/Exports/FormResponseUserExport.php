<?php

namespace App\Exports;

use App\Form;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class FormResponseUserExport implements FromView
{
    public $form,$user_id;

    public function __construct(Form $form,$user_id)
    {
        $this->form = $form;
        $this->user_id = $user_id;
    }

    public function view(): View
    {
        $responses = $this->form->responses()->has('fieldResponses')->get(['id', 'created_at','respondent_id','respondent_site','respondent_country','respondent_city']);
        $fields = $this->form->fields()->with('responses')->get();
        $operation = $this->form->operations()->get()->last();
        $user_id = $this->user_id;
        return view('exports.responseuser', compact('fields', 'responses','user_id'));
    }
}
