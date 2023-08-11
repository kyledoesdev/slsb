<?php

namespace App\Http\Requests\PCParts;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePCPartRequest extends FormRequest {

    public function authorize(): bool {
        return auth()->check() && request()->profile_id == auth()->user()->profile_id;
    }

    public function rules(): array {
        return [
            'profile_id' => 'required',
            'parts' => 'required'
        ];
    }
}
