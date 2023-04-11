<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller {

    protected $user;

    public function __construct(Request $request) {
        $username = $request->route('id');

        if ($username && is_string($username) && User::where('username', $username)->exists()) {
            $this->user = User::where('username', $username)->first();
        }
    }

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

    public function followersList() {
        return view('profiles.follows', [
            'list' => $this->user->followers()->get(),
            'user' => $this->user,
        ]);
    }

    public function followingList() {
        return view('profiles.follows', [
            'list' => $this->user->following()->get(),
            'user' => $this->user,
        ]);
    }

}
