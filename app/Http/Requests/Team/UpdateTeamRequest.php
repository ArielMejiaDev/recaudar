<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:5', Rule::unique('teams', 'name')->ignore($this->team->name, 'name')],
            'category' => ['required', Rule::in(['Salud', 'Educación', 'Ambientales', 'Social', 'Nutrición', 'Pobreza', 'Animales', 'Otros'])],
            'description' => 'required|min:20',
            'public' => 'required|min:20',
            'beneficiaries' => 'required|numeric',
            'impact' => 'required|min:20',
            'legal_representative' => 'required|min:5',
            'tax_number' => 'required|min:5',
            'office_address' => 'required|min:20',
            'use_of_funds' => 'required|min:20',
            'contact' => 'required|min:5',
            'contact_phone' => 'required|min:6',
            'contact_email' => 'required|email',
        ];
    }
}
