<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Post;

class UserProfileController extends Controller {

    public function index($id) {
        $user = User::where('username', $id)->first();
        $post = Post::where('user_id', $user->id)
            ->where('is_featured', true)
            ->first();

        abort_if($user == null, 404);

        return view('profiles.index', [
            'user' => $user,
            'post' => $post
        ]);
    }

    public function edit($id) {
        $user = User::where('username', $id)->first();
        return view('profiles.edit', ['user' => $user]);
    }

    public function update(UpdateUserProfileRequest $request, $id) {
        $user = User::where('username', $id)->first();
        abort_if($user == null, 404);

        if ($user->external_id == null) {

            if ($request->input('avatar-type') && $request->input('seed')) {
                $new_avatar = $user->generateNewAvatar($request->input('avatar-type'), $request->input('seed'));
            }

            $user->update([
                'first_name' => $request->first_name ?? $user->first_name,
                'last_name' => $request->last_name ?? $user->last_name,
            ]);

            UserProfile::where('user_id', $user->id)
                ->update([
                    'bio' => $request->bio ?? $user->profile->bio,
                    'location' => $request->location ?? $user->profile->location,
                    'avatar' => $new_avatar ?? $user->profile->avatar,
                    'birthday' => $request->birthday ?? $user->profile->birthday,
                ]);
        } else {
            $user->update([
                'first_name' => $request->first_name ?? $user->first_name,
                'last_name' => $request->last_name ?? $user->last_name,
            ]);

            UserProfile::where('user_id', $user->id)
                ->update([
                    'birthday' => $request->birthday ?? $user->profile->birthday,
                    'location' => $request->location ?? $user->profile->location,
                ]);
        }

        return redirect()->route('profile', ['id' => $user->username]);
    }


}
