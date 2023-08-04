<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\PCPart;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller {
    protected $user;

    public function __construct(Request $request) {
        $this->user = User::query()
            ->where('username', $request->route('id'))
            ->with('profile.pcParts')
            ->firstOrFail();
    }

    public function show() {
        return view('profiles.show', [
            'user' => $this->user,
            'featuredPost' => Post::getFeaturedPostForUser($this->user),
            'posts' => Post::getAllPostsForAUser($this->user),
            'profileParts' => $this->user->profile->pcParts
        ]);
    }

    public function edit() {
        return view('profiles.edit', ['user' => $this->user]);
    }

    public function update(UpdateUserProfileRequest $request) {
        $this->user->updateUserProfile(collect($request->all()));
        return redirect()->route('profile.show', ['id' => $this->user->username]);
    }
}
