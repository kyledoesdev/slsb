<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller {
    public function follow($id) {
        $follower = auth()->user();
        $followee = User::findOrFail($id);

        $follower->follow($followee);

        return response()->json([
            'followersCount' => count($followee->followers),
            'followingCount' => count($followee->following),
        ]);
    }

    public function unfollow($id) {
        $follower = auth()->user();
        $followee = User::findOrFail($id);

        $follower->unfollow($followee);

        return response()->json([
            'followersCount' => count($followee->followers),
            'followingCount' => count($followee->following),
        ]);
    }
}
