<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers {
    use PasswordValidationRules;

    public function create(array $input) {
        Validator::make($input, [
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique(User::class)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ],[
            'username.required' => 'The :attribute is required and must only have alpha-numeric characters, as well as dashes and underscores.'
        ])->validate();

        $user = User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'profile_id' => UserProfile::create([
                'avatar' => "https://avatars.dicebear.com/api/identicon/" . $input['username'] . ".svg"
            ])->pluck('id')->first(),
            'user_type_id' => UserType::BASIC //Default all users to Basic. Only admin users can make other admins
        ]);

        $profile = UserProfile::where('id', $user->profile_id)->first();
        $profile->user_id = $user->id;
        $profile->save();

        return $user;
    }
}
