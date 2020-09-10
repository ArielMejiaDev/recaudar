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
            'currency' => Rule::in(['GTQ', 'USD']),
            'info' => 'nullable|string|min:20',
            'amount' => is_null($this->amount) ? 'nullable' : 'numeric',
            'banner' => 'nullable|image',
        ];
    }
}
