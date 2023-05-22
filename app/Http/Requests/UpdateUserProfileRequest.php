<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest {

    public function authorize() {
        return auth()->check() && auth()->id() == $this->user_id;
    }

    public function rules() {
        //If not a twitch user
        if (! auth()->user()->isTwitchUser()) {
            return [
                'user_id' => 'required',
                'first_name' => 'nullable|string|max:32',
                'last_name' => 'nullable|string|max:32',
                'bio' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:64',
                'avatar-type' => 'nullable|string|',
                'seed' => 'nullable|string|max:32',
                'birthday' => 'nullable|date',
                'background_color' => 'nullable',
            ];
        }

        return [
            'user_id' => 'required',
            'first_name' => 'nullable|string|max:32',
            'last_name' => 'nullable|string|max:32',
            'location' => 'nullable|string|max:64',
            'birthday' => 'nullable|date',
            'background_color' => 'nullable',
        ];
    }
}
