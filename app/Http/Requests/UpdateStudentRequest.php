<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'bail|required|string|max:255',      //Stop at  Validation when
            'lastname'  => 'bail|required|string|max:255',      //  this two failed
            'birthdate' => 'sometimes|date',
            'sex'       => 'sometimes|in:MALE,FEMALE',
            'address'   => 'sometimes|string',
            'year'      => 'sometimes|integer|min:1|max:4',
            'course'    => 'sometimes|in:BSCS,BSIT',
            'section'   => 'sometimes|in:A,B,C,D',
        ];
    }
    public function messages()
    {
        return [
            'firstname' => 'First Name Required!',
            'lastname'  => 'Last Name Required!',
            'birthdate' => 'Enter a Correct Date Format',
            'sex'       => 'Select: MALE or FEMALE',
            'address'   => 'Enter a Proper Address',
            'year'      => 'Select: Year -> 1, 2, 3, 4',
            'course'    => 'Select: BSIT or BSCS',
            'section'   => 'Select: A, B, C, D',
        ];
    }
}
