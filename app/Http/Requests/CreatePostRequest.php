<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PostRule;

class CreatePostRequest extends FormRequest {

    public function authorize() {
        return auth()->check();
    }

    public function rules() {
        return [
            'user_id' => 'required',
            'title' => 'required|min:2|max:48',
            'body' => 'nullable',
            'is_featured' => new PostRule,
        ];
    }
}
