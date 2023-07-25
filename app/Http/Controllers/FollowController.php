<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller {
    public function follow($id) {
        $followee = User::findOrFail($id);

        auth()->user()->follow($followee);

        return response()->json([
            'followersCount' => count($followee->followers),
            'followingCount' => count($followee->following),
        ]);
    }

    public function unfollow($id) {
        $followee = User::findOrFail($id);

        auth()->user()->unfollow($followee);

        return response()->json([
            'followersCount' => count($followee->followers),
            'followingCount' => count($followee->following),
        ]);
    }
}
