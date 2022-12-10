<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest {
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
        //If not a twitch user
        if (!auth()->user()->isTwitchUser()) {
            return [
                'first_name' => 'nullable|string|max:32',
                'last_name' => 'nullable|string|max:32',
                'bio' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:64',
                'avatar-type' => 'nullable|string|',
                'seed' => 'nullable|string|max:32',
                'birthday' => 'nullable|date',
            ];
        }

        return [
            'first_name' => 'nullable|string|max:32',
            'last_name' => 'nullable|string|max:32',
            'location' => 'nullable|string|max:64',
            'birthday' => 'nullable|date',
        ];
    }
}
