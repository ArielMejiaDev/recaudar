<?php

namespace App\Http\Requests\Team\Plan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title' => ['required', 'string', 'min:3', Rule::unique('plans', 'title')->ignore($this->plan->id)],
            'amount_in_local_currency' => is_null($this->amount_in_local_currency) ? 'nullable' : 'numeric',
            'amount_in_dollars' => is_null($this->amount_in_dollars) ? 'nullable' : 'numeric',
            'info' => 'nullable|string|min:20',
            'banner' => 'nullable|image',
        ];
    }
}
