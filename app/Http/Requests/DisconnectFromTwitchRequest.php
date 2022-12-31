<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisconnectFromTwitchRequest extends FormRequest {

    public function authorize() {
        return auth()->user()->isTwitchUser();
    }

    public function rules() {
        return [
            'password' => 'required|min:8|max:8|confirmed'
        ];
    }
}
