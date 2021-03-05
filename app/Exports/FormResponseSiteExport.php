<?php

namespace App\Exports;

use App\Form;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class FormResponseSiteExport implements FromView
{
    public $form,$site_id;

    public function __construct(Form $form,$site_id)
    {
        $this->form = $form;
        $this->site_id = $site_id;
    }

    public function view(): View
    {
        $responses = $this->form->responses()->has('fieldResponses')->get(['id', 'created_at','respondent_id','respondent_site','respondent_country','respondent_city']);
        $fields = $this->form->fields()->with('responses')->get();
        $operation = $this->form->operations()->get()->last();
        $site_id = $this->site_id;
        return view('exports.responsesite', compact('fields', 'responses','site_id'));
    }
}
