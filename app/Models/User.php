<?php

namespace App\Models;

use App\Models\Like;
use App\Models\UserProfile;
use App\Models\UserType;
use App\Traits\Follows;
use App\Traits\Likes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Likes;
    use Follows;

    public $table = 'users';

    protected $fillable = [
        'external_id',
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'timezone',
        'profile_id',
        'user_type_id',
        'external_token',
        'external_refresh_token',
        'connected_timestamp',
        'twitch_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'profile'
    ];

    public function getProfileForUsername($username) {
        return self::query()
            ->where('username', $username)
            ->first()
            ->profile;
    }

    public function followers() {
        return $this->belongsToMany(User::class, 'follows', 'followee_user_id', 'follower_user_id')
            ->withTimestamps()
            ->whereNull('deleted_at');
    }

    public function following() {
        return $this->belongsToMany(User::class, 'follows', 'follower_user_id', 'followee_user_id')
            ->withTimestamps()
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

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function getId() {
        return $this->id;
    }

    public function getUserName() {
        return $this->username;
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

    public function getUserProfileId() {
        return $this->profile->getId();
    }

    public function isAdmin() : bool {
        return $this->getUserTypeId() == UserType::ADMIN || UserType::SUPER_ADMIN;
    }

    public function isTwitchUser() : bool {
        return $this->external_id != null;
    }

    public function updateUserProfile($updates) {

        $updates['avatar'] = $this->profile->avatar;

        if (isset($updates['avatar_type']) && isset($updates['seed'])) {
            $updates['avatar'] = $this->generateNewAvatar($updates['avatar_type'], $updates['seed']);
        }
        
        $this->update([
            'first_name' => $updates['first_name'] ?? $this->first_name,
            'last_name' => $updates['last_name'] ?? $this->last_name
        ]);

        $fields = ['birthday', 'location', 'bio', 'avatar', 'background_color'];

        foreach ($fields as $field) {
            $this->profile->{$field} = isset($updates[$field]) ? $updates[$field] : $this->profile->{$field};
        }

        $this->profile->save();
    }
}
