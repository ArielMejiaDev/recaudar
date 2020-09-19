<?php

namespace App\Http\Requests\Admin\Team\Plan;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanRequest extends FormRequest
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
            'title' => ['required', 'min:5'],
            'amount_in_local_currency' => is_null($this->amount_in_local_currency) ? 'nullable' : 'numeric',
            'amount_in_dollars' => is_null($this->amount_in_dollars) ? 'nullable' : 'numeric',
            'info' => ['nullable', 'min:10'],
            'banner' => ['nullable', 'image']
        ];
    }
}
