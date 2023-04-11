<?php

use Illuminate\Support\Facades\Route;

function get_route() : string {
    return Route::currentRouteName();
}

function getDeviceTimezone() : string {
    $ip = file_get_contents("http://ipecho.net/plain");
    $url = 'http://ip-api.com/json/'.$ip;

    return  json_decode(file_get_contents($url), true)['timezone'];
}

/**
 * Grabs auth()->user()->timezone, otherwise session timezone based off device ip.
 * 
 * @return string
 */
function timezone() : string {
    return auth()->user() && auth()->user()->timezone
        ? auth()->user()->timezone
        : getDeviceTimezone();
}