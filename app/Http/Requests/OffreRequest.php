<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OffreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_email'   => "unique:users,email",
            'email_entreprise' =>"unique:entreprises,email"
        ];
    }

    public function messages()
    {
       return [
           'user_email.unique'=> trans('The user email has already been taken'),
           'email_entreprise.unique'=> trans('The entreprise email has already been taken'),
        ];
    }
}
