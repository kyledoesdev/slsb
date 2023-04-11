<?php

namespace App\Http\Requests\Comments;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $commentToDelete = Comment::query()
            ->where('id', request()->route('commentId'))
            ->first();

        return auth()->check() && $commentToDelete && $commentToDelete->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:255'
        ];
    }
}
