<?php

namespace Database\Seeders;

use App\Models\PCPart;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserProfilePCPart;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder {

    public function run() {
        UserType::updateOrCreate(['id' => UserType::SUPER_ADMIN], ['name' => 'Super Admin']);
        UserType::updateOrCreate(['id' => UserType::ADMIN], ['name' => 'Admin']);
        UserType::updateOrCreate(['id' => UserType::BASIC], ['name' => 'Basic']);
        UserType::updateOrCreate(['id' => UserType::GUEST], ['name' => 'Guest']);

        $user = User::updateOrCreate([
            'username' => 'Test_Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'profile_id' => UserProfile::create([
                'avatar' => "https://avatars.dicebear.com/api/identicon/" . 'Test_Admin' . ".svg"
            ])->pluck('id')->first(),
            'user_type_id' => UserType::SUPER_ADMIN,
            'timezone' => 'America/New_York'
        ]);

        $profile = UserProfile::query()
            ->where('id', $user->profile_id)
            ->first();

        $profile->user_id = $user->id;
        $profile->save();

        $user->touch();
        $profile->touch();
    }
}
