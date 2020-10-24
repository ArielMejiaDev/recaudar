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
            'contact' => 'required|min:5|max:100|string',
            'contact_phone' => 'required|min:6|max:100',
            'contact_email' => 'required|email|max:64',
            'office_address' => 'required|min:20|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'contact' => trans('Contact'),
            'contact_phone' => trans('Contact Phone'),
            'contact_email' => trans('Contact Email'),
            'office_address' => trans('Office Address'),
        ];
    }
}
