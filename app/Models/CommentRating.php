<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentRating extends Model {
    protected $fillable = [
        'comment_id',
        'user_id',
        'rating_type',
        'up',
        'down'
    ];

    public $casts = [
        'up' => 'boolean',
        'down' => 'boolean'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function($rating) {
            $rating->user_id = auth()->id();
        });
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function isUpVoted() : bool {
        return $this->up;
    }

    public function isDownVoted() : bool {
        return $this->down;
    }
}
