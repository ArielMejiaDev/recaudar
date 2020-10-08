<?php

namespace App\Http\Requests\Landing\Payment;

use App\Models\Team;
use App\Strategies\Validations\ValidAmountByCountryStrategy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $countryValidation = new ValidAmountByCountryStrategy($this->team->country);

        $amountRule = ['amount' => ['required', 'numeric']];
        if(app()->environment('production')) {
            $amountRule = [
                'amount' => [
                    'required',
                    'numeric',
                    'min:' . $countryValidation->minimiumAmount(),
                    'max:' . $countryValidation->maximumAmount()
                ]
            ];
        }

        return array_merge($amountRule, [
            'email' => ['required', 'email'],
            'name' => ['required', 'min:5'],
            'card' => ['required', 'min:12'],
            'month' => ['required', 'min:2', 'max:2'],
            'year' => ['required', 'min:2', 'max:2'],
            'cvc' => ['required', 'min:3'],
            'currency' => ['required', Rule::in(['GTQ', 'USD'])],
            'recurrence' => ['boolean'],
            'deviceFingerprintID' => ['required', 'min:13']
        ]);
    }
}
