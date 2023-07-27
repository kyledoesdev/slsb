<?php

namespace App\Models;

use App\Models\Model;

class PCPart extends Model
{
    const CPU = 0;
    const GPU = 1;
    const RAM = 2;
    const PSU = 3;
    const STORAGE = 4;
    const COOLING = 5;
    const CASE = 6;
    const MONITOR = 7;
    const KEYBOARD = 8;
    const MOUSE = 9;
    const HEADPHONES = 10;

    public static $parts = [
        1 => 'CPU',
        2 => 'GPU',
        3 => 'RAM',
        4 => 'PSU',
        5 => 'STORAGE',
        6 => 'COOLING',
        7 => 'CASE',
        8 => 'MONITOR',
        9 => 'KEYBOARD',
        10 => 'MOUSE',
        11 => 'HEADPHONES',
    ];

    protected $table = 'pc_parts';

    protected $fillable = [
        'profile_id',
        'part_type',
        'part_description',
    ];

    public static function getPart($partId) {
        return self::$parts[$partId];
    }
}
