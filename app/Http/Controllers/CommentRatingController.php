<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentRating;
use Illuminate\Http\Request;

class CommentRatingController extends Controller {
    public function vote(Request $request, $id) {
        $comment = Comment::find($id);
        $upVote = $request->input('up');
        $downVote = $request->input('down');
        $type = $request->input('type');

        $commentRating = CommentRating::query()
            ->withTrashed()
            ->where('comment_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($commentRating) {
            if ($type == $commentRating->rating_type) {
                $commentRating->update(['rating_type' => null]);
                $commentRating->delete();

                $comment->touch();

                return response()->json([
                    'commentRating' => $commentRating,
                    'vote_count' => CommentRating::where('comment_id', $id)->where('rating_type', 'up')->count()
                ]);
            } else if ($commentRating->trashed()) {
                $commentRating->restore();
            }
            
            $commentRating->update([
                'up' => $upVote, 
                'down' => $downVote, 
                'rating_type' => $type,
            ]);

        } else {
            $commentRating = CommentRating::create([
                'comment_id' => $id,
                'up' => $upVote, 
                'down' => $downVote, 
                'rating_type' => $type,
            ]);
        }

        return response()->json([
            'commentRating' => $commentRating,
            'vote_count' => CommentRating::where('comment_id', $id)->where('rating_type', 'up')->count()
        ], 200);
    }
}
