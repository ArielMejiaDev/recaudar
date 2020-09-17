<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeamRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5', Rule::unique('teams')],
            'category' => ['required', 'string', Rule::in(['Salud', 'Educación', 'Ambientales', 'Social', 'Nutrición', 'Pobreza', 'Animales', 'Otros'])],
            'description' => 'required|min:20|string',
            'public' => 'required|min:20|string',
            'beneficiaries' => 'required|numeric',
            'impact' => 'required|min:20|string',
            'use_of_funds' => 'required|min:20|string',
            'legal_representative' => 'required|min:5|string',
            'tax_number' => 'required|min:5',
            'country' => 'required', Rule::in(['Guatemala', 'El Salvador', 'Honduras', 'Panama', 'Costa Rica']),
            'bank' => 'required|min:5',
            'account_number' => 'required|min:7',
            'contact' => 'required|min:5|string',
            'contact_phone' => 'required|min:6',
            'contact_email' => 'required|email',
            'office_address' => 'required|min:20',
        ];
    }
}
