<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'subject_code' => 'string|max:255',
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'instructor' => 'string|max:255',
            'schedule' => 'string|max:255',
            'grades.prelims' => 'numeric',
            'grades.midterms' => 'numeric',
            'grades.pre_finals' => 'numeric',
            'grades.finals' => 'numeric',
            'date_taken' => 'date',
            'student_id' => 'exists:students,id'
        ];
    }
}
