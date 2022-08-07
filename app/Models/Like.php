<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Like extends Model {
    use SoftDeletes;

    protected $table = 'likes';

    protected $fillable = ['likers_user_id', 'post_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
