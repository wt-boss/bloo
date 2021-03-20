<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\StoreUserRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
          response()->json([
            'status' => 422,
            'message' => $validator->errors()
          ], 422)
        );
      }

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
            'first_name' => 'required|string|max:255|min:2',
            'last_name' => 'nullable|max:255|min:5',
            // 'phone' => 'required|digits:9',
            // 'phonepaiement' => 'required|digits:9',
            // 'country_id' => 'required|exists:countries,id',
            // 'state_id' => 'required|exists:states,id',
            // 'city_id' => 'required|exists:cities,id',
        ];
    }
}
