<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;
    use SoftDeletes;

    public $table = 'posts';

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
            $userId = Auth::check() ? auth()->id() : null;
            $post->user_id = $userId;
        });
    }

    /**
     * Queries
     */

    public static function getFeaturedPostForUser(User $user) {
        return self::query()
            ->where('user_id', $user->id)
            ->where('is_featured', true)
            ->first();
    }

    public static function getAllPostsForAUser(User $user) {
        return self::query()
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user->getId();
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

    public function updatePost($updates) {
        $this->update([
            'title' => $updates['title'],
            'body' => $updates['body'] === null ? '' : $updates['body'],
            'is_featured' => $updates['is_featured'] !== null && $updates['is_featured'] === 'on' ? true : $this->isFeatured()
        ]);
    }

}
