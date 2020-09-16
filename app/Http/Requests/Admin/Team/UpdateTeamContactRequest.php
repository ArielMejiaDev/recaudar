<?php

namespace App\Http\Requests\Admin\Team;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamContactRequest extends FormRequest
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
            'contact' => ['required', 'min:5'],
            'contact_phone' => ['required', 'min:5'],
            'contact_email' => ['required', 'email'],
            'office_address' => ['required', 'min:15']
        ];
    }
}
