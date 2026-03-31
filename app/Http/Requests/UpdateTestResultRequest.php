<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestResultRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Hospital users can update test results for their own hospital
        return auth()->check() && auth()->user()->hasRole('hospital');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'result' => ['required', 'in:positive,negative,pending'],
            'doctor_notes' => ['nullable', 'string'],
            'result_date' => ['required', 'date'],
        ];
    }
}
