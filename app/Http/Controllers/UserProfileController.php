<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Post;

class UserProfileController extends Controller {

    protected $user;

    public function __construct(Request $request) {
        $this->user = User::where('username', $request->route('id'))->firstOrFail();
    }

    public function show($id) {
        return view('profiles.show', [
            'user' => $this->user,
            'featuredPost' => Post::getFeaturedPostForUser($this->user),
            'posts' => Post::getAllPostsForAUser($this->user),
        ]);
    }

    public function edit($id) {
        return view('profiles.edit', ['user' => $this->user]);
    }

    public function update(UpdateUserProfileRequest $request, $id) {
        $this->user->updateUserProfile(collect($request->all()));
        return redirect()->route('profile.show', ['id' => $this->user->username]);
    }
}
