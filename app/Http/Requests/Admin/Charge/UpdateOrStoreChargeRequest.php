<?php

namespace App\Http\Requests\Admin\Charge;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrStoreChargeRequest extends FormRequest
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
            'country' => ['required', Rule::in(['Guatemala', 'El Salvador', 'Honduras', 'Panama', 'Costa Rica'])],
            'country_charge' => ['required', 'numeric', 'min:0.1', 'max:9.9'],
            'payment_gateway' => ['required', Rule::in(['pagalogt', 'pagadito', 'paypal', 'bac', 'payu'])],
            'payment_gateway_charge' => ['required', 'numeric', 'min:0.1', 'max:9.9'],
        ];
    }
}
