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

    static function getAdminTypeIds() : array {
        return [
            UserType::SUPER_ADMIN,
            UserType::ADMIN
        ];
    }

}
