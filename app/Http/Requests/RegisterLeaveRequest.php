<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class RegisterLeaveRequest extends FormRequest
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
            'request_for_date' => 'required|date_format:Y-m-d',
            'checkin' => 'required|date_format:H:i',
            'checkout' => 'required|date_format:H:i',
            'leave_start' => 'nullable|date_format:H:i',
            'leave_end' => 'nullable|date_format:H:i',
            'reason' => 'required',
            'paid' => [
                'required',
                Rule::in(["2", "3"])
            ]
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
