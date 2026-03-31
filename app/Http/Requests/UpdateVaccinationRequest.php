<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVaccinationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Hospital users can update vaccination records for their own hospital
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
            'vaccine_id' => ['required', 'exists:vaccines,id'],
            'dose' => ['required', 'in:first,second,booster'],
            'vaccination_date' => ['required', 'date'],
        ];
    }
}
