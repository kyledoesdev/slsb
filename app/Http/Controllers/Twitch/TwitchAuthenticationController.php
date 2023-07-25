<?php

namespace App\Http\Controllers\Twitch;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\DisconnectFromTwitchRequest;

class TwitchAuthenticationController extends Controller {

    public function redirectToTwitchProvider() {
        return Socialite::driver('twitch')
            ->scopes(['user:read:follows'])
            ->redirect();
    }

    public function handleTwitchProviderCallback() {
        $twitchUser = Socialite::driver('twitch')->stateless()->user();

        //try to find a user with email from socialite user exists but they are not a twitch user
        $user = User::query()
            ->where('email', $twitchUser->email)
            ->where('external_id', null);

        //if that user exists, then they are trying to connect their account to twitch
        if ($user->exists()) {
            $user = $user->first();
            return self::connectAccountWithTwitch($twitchUser, $user);
        }

        $usernameExists = User::query()
            ->where('username', '!=', null)
            ->where('external_id', $twitchUser->id);

        $user = User::updateOrCreate([
            'external_id' => $twitchUser->id,
        ], [
            'external_id' => $twitchUser->id,
            'username' => $usernameExists->exists() ? $usernameExists->first()->username : $twitchUser->name,
            'twitch_name' => $twitchUser->name,
            'email' => $twitchUser->email,
            'timezone' => getDeviceTimezone(),
            'user_type_id' => $usernameExists->exists() ? $usernameExists->first()->user_type_id : UserType::BASIC,
            'external_token' => $twitchUser->token,
            'external_refresh_token' => $twitchUser->refreshToken,
            'connected_timestamp' => $usernameExists->exists()
                ? $usernameExists->first()->connected_timestamp
                : now()
        ]);

        $profile = UserProfile::updateOrCreate([
            'user_id' => $user->id
        ], [
            'avatar' => $twitchUser->avatar,
            'bio' => $twitchUser->user['description']
        ]);

        if ($user->profile_id == null) {
            $user->profile_id = $profile->id;
            $user->save();
        }

        Auth::login($user);
        return redirect('home');
    }

    public static function connectAccountWithTwitch($twitchUser, $existingUser) {
        /**
         * Check user is not trying to reconnect after disconnecting not long ago
         */
        $connectedAt = Carbon::parse($existingUser->connected_timestamp);

        if ($connectedAt->diffInDays(now()) < 0) {
            return redirect()->route('profile.show', ['id' => $existingUser->username])
                ->withErrors(['error' => 'You must wait 24 hours']);
        }

        /**
         * If user's original email does not match the email the user wants to connect their account to
         */
        if ($twitchUser->email !== $existingUser->email) {
            return redirect()->route('profile.show', ['id' => $existingUser->username])
                ->withErrors(['error' => 'Could not connect your account with your twitch account. An account with the email that your twitch account is using already exists.']);
        }

        /**
         * If the user's twitch accounts username is taken
         */
        $usernameExists = User::where('username', $twitchUser->name);
        if ($usernameExists->exists() && $usernameExists->first()->username != $existingUser->username) {
            return redirect()->route('profile.show', ['id' => auth()->user()->username])
                ->withErrors(['error' => 'Another user already has claimed the username of your twitch account. Contact us to get this resolved.']);
        }

        /**
         * If there is already a twitch user registered
         */
        if (User::where('external_id', $twitchUser->id)->exists()) {
            return back()->withErrors(['error' => 'A twitch account with this username/email already exists.']);
        }

        $existingUser->update([
            'external_id' => $twitchUser->id,
            'twitch_name' => $twitchUser->name,
            'password' => null,
            'external_token' => $twitchUser->token,
            'external_refresh_token' => $twitchUser->refreshToken,
            'connected_timestamp' => now(),
            'profile_id' => UserProfile::updateOrCreate([
                'user_id' => $existingUser->id
            ], [
                'avatar' => $twitchUser->avatar,
                'bio' => $twitchUser->user['description']
            ])->pluck('id')->first(),
        ]);

        Auth::login($existingUser);

        return redirect('home')->with('success', 'Your account has been connected to the twitch user '. $twitchUser->name);

    }

    public function disconnectFromTwitch(DisconnectFromTwitchRequest $request) {
        UserProfile::where('user_id', auth()->id())
            ->update([
                'avatar' => "https://avatars.dicebear.com/api/identicon/" . auth()->user()->username . ".svg",
                'bio' => null
            ]);

        if ($request->input('password') === $request->input('password_confirmation')) {
            auth()->user()->update([
                'twitch_name' => null,
                'external_id' => null,
                'external_token' => null,
                'external_refresh_token' => null,
                'password' => bcrypt($request->input('password')),
            ]);
        }

        return redirect()->route('profile.show', ['id' => auth()->user()->username])
            ->with('success', 'You have disconnected from twitch.');
    }

}
