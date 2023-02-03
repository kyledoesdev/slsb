<?php

use Illuminate\Support\Facades\Route;

function get_route() : string {
    return Route::currentRouteName();
}