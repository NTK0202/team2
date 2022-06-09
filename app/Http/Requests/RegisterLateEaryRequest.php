<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class RegisterLateEaryRequest extends FormRequest
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
            'reason' => 'required|string|max:100',
            'request_for_date' => 'required|date',
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(collect($validator->errors())->map(function ($error) {
            return $error[0];
        }), Response::HTTP_UNPROCESSABLE_ENTITY));
    }

}
