<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model {
    use SoftDeletes;

    public $table = 'follows';

    /**
     * Follower is typically $this user.
     * Is $this user a "follower" of the $followee
     */
    protected $fillable = ['follower_user_id', 'followee_user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
