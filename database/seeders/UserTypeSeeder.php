<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;
use App\Models\UserProfile;
use App\Models\User;

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
            'user_type_id' => UserType::SUPER_ADMIN
        ]);

        UserProfile::where('id', $user->profile_id)
            ->update(['user_id' => $user->getId()]);
    }
}
