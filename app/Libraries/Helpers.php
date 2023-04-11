<?php

namespace App\Libraries;

use App\Models\UserType;

class Helpers {

    static function possessive($username) {
        $lastLetter = substr($username, -1);

        if ($lastLetter === 's') {
            return $username . "'";
        }

        return $username . "'s";
    }

    static function checkForUserBackgroundColor($user) : bool {
        return
            $user !== null && 
            $user->profile &&
            $user->profile->background_color &&
            get_route() === 'profile.show';
    }

    static function getAdminTypeIds() : array {
        return [
            UserType::SUPER_ADMIN,
            UserType::ADMIN
        ];
    }

}
