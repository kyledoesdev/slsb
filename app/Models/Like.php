<?php

namespace App\Models;

use App\Models\Model;

class Like extends Model {
    protected $table = 'likes';

    protected $fillable = ['likers_user_id', 'post_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
