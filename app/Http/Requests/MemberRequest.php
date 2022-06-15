<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class MemberRequest extends FormRequest
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
            'gender' => 'required',
            'birth_date' => 'required|date_format:Y-m-d',
            'other_email' => 'required|email',
            'identity_number' => 'required|regex:/^\d+$/|max:12',
            'identity_card_date' => 'required|date_format:Y-m-d',
            'identity_card_place' => 'required|max:50',
            'skype' => 'nullable|max:30',
            'passport_number' => 'nullable|max:20',
            'passport_expiration'  => 'nullable|date_format:Y-m-d',
            'nationality' => 'required|max:50',
            'bank_name' => 'required|max:70',
            'bank_account' => 'required|regex:/^\d+$/|max:20',
            'marital_status' => 'required',
            'academic_level' => 'max:50',
            'permanent_address' => 'required|max:255',
            'temporary_address' => 'required|max:255',
            'tax_identification' => 'nullable|max:20',
            'insurance_number' => 'nullable|max:20',
            'healthcare_provider' => 'nullable|max:30',
            'emergency_contact_relationship' => 'required|max:50',
            'emergency_contact_name' => 'required|max:70',
            'emergency_contact_number' => 'required|regex:/^\d+$/|max:20',
            'start_date_official' => 'nullable|date_format:Y-m-d',
            'start_date_probation' => 'nullable|date_format:Y-m-d'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
