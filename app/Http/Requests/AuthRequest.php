<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
        if ($this->method() == "POST"){
            return [
                'email' => 'required|email',
                'password' => 'required|string|min:8|max:32',
            ];
        }

        if ($this->method() == "PUT"){
            return [
                'old_password' => 'required|string|min:8|max:32',
                'new_password' => 'required|string|confirmed|min:8|max:32',
                'new_password_confirmation' => 'required|string|min:8|max:32',
            ];
        }
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(collect($validator->errors())->map(function ($error) {
            return $error[0];
        }), Response::HTTP_UNPROCESSABLE_ENTITY));
    }

}
