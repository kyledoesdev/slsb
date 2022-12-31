<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Post;
use App\Rules\PostRule;

class UpdatePostRequest extends FormRequest {

    public function authorize() {
        $post = Post::query()
            ->where('id', $this->post_id)
            ->first();

        return $post !== null && $post->user_id === auth()->id();
    }

    public function rules() {
        return [
            'post_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'body' => 'nullable',
            'is_featured' => new PostRule
        ];
    }
}
