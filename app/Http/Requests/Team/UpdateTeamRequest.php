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
            'name' => ['required', 'min:5', 'max:100', Rule::unique('teams', 'name')->ignore($this->team->name, 'name')],
            'beneficiaries' => 'required|numeric|min:2',
            'public' => 'required|min:20|string|max:100',
            'category' => ['required', 'string', 'min:3', 'max:30', Rule::in(['Salud', 'Educación', 'Ambientales', 'Social', 'Nutrición', 'Pobreza', 'Animales', 'Otros'])],
            'impact' => 'required|min:20|max:500|string',
            'use_of_funds' => 'required|min:20|max:500|string',
            'description' => 'required|min:20|string',
            'contact' => 'required|min:5|max:100|string',
            'contact_phone' => 'required|min:6|max:100',
            'contact_email' => 'required|email|max:64',
            'office_address' => 'required|min:20|max:100',
            'legal_representative' => 'required|min:5|max:100|string',
            'tax_number' => 'required|min:5|max:100',
            'country' => ['required', 'min:3', 'max:75', Rule::in(['Guatemala', 'El Salvador', 'Honduras', 'Panama', 'Costa Rica'])],
            'bank' => 'required|min:5|max:50',
            'account_number' => 'required|min:7|max:20',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('Name'),
            'beneficiaries' => trans('Beneficiaries'),
            'public' => trans('Public'),
            'category' => trans('Category'),
            'impact' => trans('Impact'),
            'use_of_funds' => trans('Use Of Funds'),
            'description' => trans('Description'),
            'contact' => trans('Contact'),
            'contact_phone' => trans('Contact Phone'),
            'contact_email' => trans('Contact Email'),
            'office_address' => trans('Office Address'),
            'legal_representative' => trans('Legal Representative'),
            'tax_number' => trans('Tax Number'),
            'country' => trans('Country'),
            'bank' => trans('Bank'),
            'account_number' => trans('Account Number'),
        ];
    }
}
