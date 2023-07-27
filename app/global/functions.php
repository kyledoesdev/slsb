<?php

use App\Models\PCPart;
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

function getPCPartImg(int $partId) : string {
    return '/img/' . PCPart::getPart($partId) . '.png';
}