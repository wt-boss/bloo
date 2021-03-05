<?php

namespace App\Exports;

use App\Form;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class FormResponseCityExport implements FromView
{
    public $form,$city_id;

    public function __construct(Form $form,$city_id)
    {
        $this->form = $form;
        $this->city_id = $city_id;
    }

    public function view(): View
    {
        $responses = $this->form->responses()->has('fieldResponses')->get(['id', 'created_at','respondent_id','respondent_site','respondent_country','respondent_city']);
        $fields = $this->form->fields()->with('responses')->get();
        $operation = $this->form->operations()->get()->last();
        $city = $this->city_id;
        return view('exports.responsecity', compact('fields', 'responses','city'));
    }
}
