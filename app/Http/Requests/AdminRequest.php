<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class AdminRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->method() == 'GET') {
            return [
                'start_date' => 'nullable|date|date_format:Y-m-d',
                'end_date' => 'nullable|date|date_format:Y-m-d',

                'order_request_for_date' => [
                    'nullable',
                    Rule::in(["asc", "desc"])
                ],

                'per_page' => [
                    'nullable',
                    Rule::in(config('common.per_page')),
                ],
            ];
        } else {
            return [
                'status' => [
                    'required',
                    Rule::in([-1, 2]),
                ],
                'comment' => 'required|string|max:100',
            ];
        }
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(collect($validator->errors())->map(function ($error) {
            return $error[0];
        }), Response::HTTP_UNPROCESSABLE_ENTITY));
    }

}
