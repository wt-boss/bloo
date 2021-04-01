<?php

namespace App\Exports;

use App\Form;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class FormResponseCountryExport implements FromView
{
    public $form,$country_id;

    public function __construct(Form $form,$country_id)
    {
        $this->form = $form;
        $this->country_id = $country_id;
    }

    public function view(): View
    {
        $responses = $this->form->responses()->has('fieldResponses')->get(['id', 'created_at','respondent_id','respondent_site','respondent_country','respondent_city']);
        $fields = $this->form->fields()->with('responses')->get();
        $operation = $this->form->operations()->get()->last();
        $country = $this->country_id;
        return view('exports.responsecountry', compact('fields', 'responses','country'));
    }
}
