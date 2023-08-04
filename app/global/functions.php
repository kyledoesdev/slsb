<?php

use App\Models\PCPart;
use App\Models\UserProfilePCPart;
use Illuminate\Support\Facades\Route;

function get_route() : string {
    return Route::currentRouteName();
}

function getDeviceTimezone() : string {
    $ip = file_get_contents("http://ipecho.net/plain");
    $url = 'http://ip-api.com/json/'.$ip;

    return json_decode(file_get_contents($url), true)['timezone'];
}

/**
 * Grabs auth()->user()->timezone, otherwise session timezone based off device ip.
 * 
 * @return string
 */
function timezone() : string {
    $user = auth()->user();

    return $user && $user->timezone ? $user->timezone : getDeviceTimezone();
}

function getBgColor($user) : bool {
    return
        $user !== null && 
        $user->profile &&
        $user->profile->background_color &&
        get_route() === 'profile.show';
}

function buildPCPartsForProfile($profileId) : void {
    //build default empty pc part list for profile
    foreach(PCPart::all() as $part) {
        UserProfilePCPart::create([
            'profile_id' => $profileId,
            'pc_part_id' => $part->id
        ]);
    }
}