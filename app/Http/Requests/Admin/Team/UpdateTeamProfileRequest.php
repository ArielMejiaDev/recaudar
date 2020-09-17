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
            'name' => ['required', 'min:5', Rule::unique('teams')->ignore($this->team)],
            'beneficiaries' => ['required', 'numeric', 'min:2'],
            'public' => ['required', 'min:5'],
            'status' => ['required', 'min:5'],
            'category' => ['required', Rule::in(['Salud', 'Educacion', 'Ambientales', 'Social', 'Nutricion', 'Pobreza', 'Animales', 'Otros'])],
            'theme' => ['required', Rule::in(['classic', 'condensed', 'columns'])],
            'impact' => ['required', 'min:10'],
            'use_of_funds' => ['required', 'min:5'],
            'description' => ['required', 'min:10'],
        ];
    }
}
