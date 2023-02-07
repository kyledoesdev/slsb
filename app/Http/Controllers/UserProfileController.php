<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfileRequest;

class UserProfileController extends Controller {

    protected $user;

    public function __construct(Request $request) {
        $this->user = User::where('username', $request->route('id'))->firstOrFail();
    }

    public function show() {
        return view('profiles.show', [
            'user' => $this->user,
            'featuredPost' => Post::getFeaturedPostForUser($this->user),
            'posts' => Post::getAllPostsForAUser($this->user),
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
