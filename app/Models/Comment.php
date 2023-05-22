<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {
    use HasFactory;
    use SoftDeletes;

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

        $userId = auth()->check() ? auth()->id() : null;

        if ($userId) {
            static::creating(function($comment) use ($userId){
                $comment->user_id = $userId;
            });
        }
    }

    public function isNotAReply() {
        return self::where('is_reply', false);
    }

    public function replies() : HasMany {
        return $this->hasMany(self::class, 'parent_id', 'id')
            ->with('replies', fn($query) => 
                $query->orderBy('created_at', 'DESC')
                    ->limit(5)
            );
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

    public function getFormattedCreatedAtAttribute() : string {
        return Carbon::parse($this->created_at)->tz(timezone())->format('M-d-Y h:i:s T');
    }

    public function getFormattedUpdatedAtAttribute() : string {
        return Carbon::parse($this->updated_at)->tz(timezone())->format('M-d-Y h:i:s T');
    }
}
