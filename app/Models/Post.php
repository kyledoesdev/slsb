<?php

namespace App\Models;

use App\Models\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Post extends Model {
    protected $table = 'posts';

    protected $fillable = [
        'user_id', 
        'title', 
        'body', 
        'is_featured', 
        'total_like_count'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function($post) {
            $post->user_id = auth()->id();
        });
    }

    /**
     * Queries
     */
    public static function getFeaturedPostForUser(User $user) : ?self {
        return self::query()
            ->where('user_id', $user->id)
            ->where('is_featured', true)
            ->first();
    }

    public static function getAllPostsForAUser(User $user) : Collection {
        return self::query()
            ->select('id', 'user_id', 'title', 'created_at')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function comments() : HasMany {
        return $this->hasMany(Comment::class);
    }

    public function likes() : HasMany {
        return $this->hasMany(Like::class);
    }

    public function getUserId() {
        return $this->user->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getBody() {
        return $this->body;
    }

    public function getNumOfLikes() {
        return $this->total_like_count;
    }

    public function isFeatured() {
        return $this->is_featured;
    }

    public function getFormattedCreatedAt() : string {
        return Carbon::parse($this->created_at)->tz(timezone())->format('M-d-Y h:i:s T');
    }

    public function updatePost($updates) : void {
        $this->update([
            'title' => $updates['title'],
            'body' => $updates['body'] === null ? '' : $updates['body'],
            'is_featured' => array_key_exists('is_featured', $updates) && $updates['is_featured']
        ]);
    }

}
