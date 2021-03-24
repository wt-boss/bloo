<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UploadPieceRequest extends FormRequest
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
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'messages' => $validator->errors()
          ], Response::HTTP_UNPROCESSABLE_ENTITY)
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
            'front' => 'required|mimes:png,jpg,jpeg|max:2048',
            'rear' => 'required|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
