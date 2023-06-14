<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowListController extends Controller {
    protected $user;

    public function __construct(Request $request) {
        $this->user = User::query()
            ->where('username', $request->route('id'))
            ->firstOrFail();
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
