<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewSubjectRequest extends FormRequest
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
            'subject_code' => 'bail|required|string|max:55',   
            'name'  => 'bail|required|string|max:255',     
            'description' => 'string|max:255',
            'instructor'  => 'required|string|max:255',
            'schedule'   => 'required|string|max:255',
            'grades.prelims' => 'required|numeric',
            'grades.midterms' => 'required|numeric',
            'grades.prefinals' => 'required|numeric',
            'grades.finals' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'subject_code' => 'Enter a Correct Subject Code',   
            'name'  => 'Enter a Known Suject Name',  
            'instructor'  => 'Enter a Valid Name',
            'schedule'   => 'Enter a valid Schedule',
        ];
    }
}
