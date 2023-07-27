<?php

namespace App\Models;

use App\Models\Model;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model {
    protected $table = 'comments';

    protected $fillable = [
        'parent_id',
        'user_id',
        'post_id',
        'comment',
        'is_reply'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function($comment) {
            $comment->user_id = auth()->id();    
        });
    }

    public function isNotAReply() {
        return self::where('is_reply', false);
    }

    public function commentRatings() : HasMany {
        return $this->hasMany(CommentRating::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function isNotReply() : bool {
        return ! $this->is_reply;
    }

    public function isReply() : bool {
        return $this->is_reply;
    }
}
