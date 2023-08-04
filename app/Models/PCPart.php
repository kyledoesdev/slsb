<?php

namespace App\Models;

use App\Models\Model;

class PCPart extends Model {
    protected $table = 'pc_parts';

    protected $fillable = [
        'name',
        'img_path'
    ];
}
