<?php

namespace App\Http\Requests\Comments;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class AddReplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $commentPostReplyigTo = Post::findOrFail($this->post_id);
        $commentReplyingTo = Comment::findOrFail(request()->route('commentId'));

        return auth()->check() && $commentPostReplyigTo->id === $commentReplyingTo->post_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:255',
            'post_id' => 'required',
        ];
    }
}
