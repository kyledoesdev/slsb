<?php

namespace App\Http\Controllers;

use App\Models\Post;
class LikeController extends Controller {

    public function like($id) {
        $post = Post::query()->with('user')->findOrFail($id);

        auth()->user()->like($post);

        return response()->json([
            'count' => $post->getNumOfLikes(),
            'totalCount' => $post->user->getAllLikes()
        ]);
    }

    public function unlike($id) {
        $post = Post::query()->with('user')->findOrFail($id);

        auth()->user()->unlike($post);

        return response()->json([
            'count' => $post->getNumOfLikes(),
            'totalCount' => $post->user->getAllLikes()
        ]);
    }
}
