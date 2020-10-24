<?php

namespace App\Http\Requests\Admin\Team;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeamFinancialDataRequest extends FormRequest
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
            'legal_representative' => trans('Legal Representative'),
            'tax_number' => trans('Tax Number'),
            'country' => trans('Country'),
            'bank' => trans('Bank'),
            'account_number' => trans('Account Number'),
        ];
    }
}
