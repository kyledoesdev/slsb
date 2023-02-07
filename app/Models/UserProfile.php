<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserProfile extends Model {

    protected $table = 'user_profiles';

    protected $fillable = [
       'user_id', 
       'avatar', 
       'bio', 
       'location'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id', 'profile_id');
    }

    public function userProfileFavoriteGames() {
        return $this->hasMany(UserProfileFavoriteGame::class, 'profile_id', 'id');
    }

    public function getId() {
        return $this->id;
    } 

    public function canHaveMoreFavoriteGames() : bool {
        return $this->userProfileFavoriteGames->count() < 9;
    }
}
