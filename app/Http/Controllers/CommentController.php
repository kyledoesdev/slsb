<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\AddReplyRequest;
use App\Http\Requests\Comments\CommentDeleteRequest;
use App\Http\Requests\Comments\CommentStoreRequest;
use App\Http\Requests\Comments\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\CommentRating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller {
    public function store(CommentStoreRequest $request) {
        Comment::create($request->validated());
        return back()->with('success', 'Commented successfully created!');
    }

    public function update(CommentUpdateRequest $request, $commentId) {
        Comment::find($commentId)->update($request->validated());
        return back()->with('success', 'Comment successfully updated!');
    }

    public function delete(CommentDeleteRequest $request, $commentId) {
        Comment::find($commentId)->delete();
        return back()->with('success', 'Comment successfully delete!');
    }

    public function reply(AddReplyRequest $request, $commentId) {
        Comment::create($request->validated() + [
            'parent_id' => $commentId,
            'is_reply' => true,
        ]);
        return back()->with('success', 'Reply was successfully added.');
    }
}
