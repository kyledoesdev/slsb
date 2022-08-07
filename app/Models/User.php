<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Post;
use App\Models\Like;
use App\Models\Follow;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'users';

    protected $fillable = [
        'external_id', 'username', 'first_name', 'last_name', 'email', 'password', 'profile_id', 'user_type_id',
        'external_token', 'external_refresh_token', 'connected_timestamp', 'twitch_name'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followers() {
        return $this->belongsToMany(User::class, 'follows', 'followee_user_id', 'follower_user_id')
            ->whereNull('deleted_at');
    }

    public function following() {
        return $this->belongsToMany(User::class, 'follows', 'follower_user_id', 'followee_user_id')
            ->whereNull('deleted_at');
    }

    public function likes() {
        return $this->hasMany(Like::class, 'likers_user_id');
    }

    public function profile() {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function userType() {
        return $this->hasOne(UserType::class, 'id', 'user_type_id');
    }

    public function getId() {
        return $this->id;
    }

    public function like(Post $post) : bool {
        $like = Like::where('likers_user_id', '=', $this->getId())
            ->where('post_id', '=', $post->getId())
            ->withTrashed()
            ->first();

        $totalLikes = $post->getNumOfLikes();

        //if a like exists, restore it
        if($like != null) {
            $like->restore();
            $post->total_like_count = $totalLikes + 1;
            $post->save();
            return true;
        }

        $like = new Like;
        $like->likers_user_id = $this->getId();
        $like->post_id = $post->getId();
        $like->save();

        $post->total_like_count = $totalLikes + 1;
        $post->save();

        return true;
    }

    public function unlike(Post $post) : bool {
        $like = Like::where('likers_user_id', '=', $this->getId())
            ->where('post_id', '=', $post->getId());

        $totalLikes = $post->getNumOfLikes();

        if ($like == null) {
            return false;
        }

        $like->delete();

        $post->total_like_count = $totalLikes - 1;
        $post->save();

        return true;
    }

    public function isLiking(Post $post) : bool {
        $like = Like::where('likers_user_id', '=', $this->getId())
            ->where('post_id', '=', $post->getId())
            ->exists();

        if($like == null) {
            return false;
        }

        return true;
    }

    public function getAllLikes() : int {
        $posts = Post::where('user_id', '=', $this->getId())
            ->get();

        if (count($posts) <= 0) {
            return 0;
        }

        $sum = 0;
        foreach($posts as $post) {
            $sum += $post->total_like_count;
        }

        return $sum;
    }

    public function follow(User $userWeAreFollowing) : bool {
        $follow = Follow::withTrashed()
            ->where('follower_user_id', $this->getId())
            ->where('followee_user_id', $userWeAreFollowing->getId())
            ->first();

        if ($follow != null) {
            $follow->restore();
            return true;
        }

        $follow = new Follow;
        $follow->follower_user_id = $this->getId(); //$this user is a new follower
        $follow->followee_user_id = $userWeAreFollowing->getId(); //the user we are following is the followee
        $follow->save();

        return true;
    }

    public function unfollow(User $userWeAreUnFollowing) : bool {
        if(!$this->isFollowing($userWeAreUnFollowing)) {
            return false;
        }

        $follow = Follow::where('follower_user_id', $this->getId())
            ->where('followee_user_id', $userWeAreUnFollowing->getId());

        if ($follow == null) {
            return false;
        }

        $follow->delete();
        return true;
    }

    public function isFollowing(User $followee) : bool {
        //checking if $this user is a follower of the $followee
        $follow = Follow::where('follower_user_id', $this->getId())
            ->where('followee_user_id', $followee->getId())
            ->first();

        if ($follow == null) {
            return false;
        }

        return true;
    }

    public function getFullNameAttribute() : string {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function generateNewAvatar($type, $seed) {
        return "https://avatars.dicebear.com/api/{$type}/{$seed}.svg";
    }

    public function getUserTypeId() {
        return $this->userType->id;
    }

    public function isAdmin() {
        return $this->getUserTypeId() == UserType::ADMIN || UserType::SUPER_ADMIN;
    }
}
