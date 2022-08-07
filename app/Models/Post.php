<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory, SoftDeletes;

    public $table = 'posts';
    protected $fillable = ['user_id', 'title', 'body', 'is_featured'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getId() {
        return $this->id;
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

}
