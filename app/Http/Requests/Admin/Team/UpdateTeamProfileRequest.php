<?php

namespace App\Http\Requests\Admin\Team;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeamProfileRequest extends FormRequest
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
            'name' => ['required', 'min:5', 'max:100', Rule::unique('teams')->ignore($this->team)],
            'beneficiaries' => ['required', 'numeric', 'min:2'],
            'public' => 'required|min:20|string|max:100',
            'category' => ['required', 'string', 'min:3', 'max:30', Rule::in(['Salud', 'Educación', 'Ambientales', 'Social', 'Nutrición', 'Pobreza', 'Animales', 'Otros'])],
            'theme' => ['required', Rule::in(['classic', 'condensed', 'columns'])],
            'impact' => 'required|min:20|max:500|string',
            'use_of_funds' => 'required|min:20|max:500|string',
            'description' => 'required|min:20|string',
            'status' => ['required', 'min:5'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('Name'),
            'beneficiaries' => trans('Beneficiaries'),
            'public' => trans('Public'),
            'category' => trans('Category'),
            'theme' => trans('Theme'),
            'impact' => trans('Impact'),
            'use_of_funds' => trans('Use Of Funds'),
            'description' => trans('Description'),
            'status' => trans('Status'),
        ];
    }
}
