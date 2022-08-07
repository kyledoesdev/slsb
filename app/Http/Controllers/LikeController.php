<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
use Log;

class LikeController extends Controller {

    public function like($id) {
        $post = Post::findOrFail($id);

        auth()->user()->like($post);

        return response()->json([
            'count' => $post->getNumOfLikes(),
            'totalCount' => auth()->user()->getAllLikes()
        ]);
    }

    public function unlike($id) {
        $post = Post::findOrFail($id);

        auth()->user()->unlike($post);

        return response()->json([
            'count' => $post->getNumOfLikes(),
            'totalCount' => auth()->user()->getAllLikes()
        ]);
    }
}
