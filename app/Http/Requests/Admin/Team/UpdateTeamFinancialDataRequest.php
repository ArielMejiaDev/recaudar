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
            'legal_representative' => ['required', 'min:5'],
            'tax_number' => ['required', 'min:5'],
            'country' => Rule::in(['Guatemala', 'El Salvador', 'Honduras', 'Panama', 'Costa Rica']),
            'account_number' => ['required', 'min:5'],
            'bank' => ['required', 'min:5'],
        ];
    }
}
