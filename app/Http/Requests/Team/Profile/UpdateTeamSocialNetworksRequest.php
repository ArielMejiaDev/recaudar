<?php

namespace App\Http\Requests\Team\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamSocialNetworksRequest extends FormRequest
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
            'facebook_account' => 'nullable|url',
            'twitter_account' => 'nullable|url',
            'instagram_account' => 'nullable|url',
        ];
    }

    public function attributes()
    {
        return [
            'facebook_account' => trans('Facebook Account'),
            'twitter_account' => trans('Twitter Account'),
            'instagram_account' => trans('Instagram Account'),
        ];
    }
}
