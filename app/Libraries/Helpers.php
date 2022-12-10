<?php

namespace App\Libraries;

class Helpers {

    static function makeUsernamePossessive($username) {

        $lastLetter = substr($username, -1);

        if ($lastLetter === 's') {
            return $username . "'";
        }

        return $username . "'s";
    }

}
