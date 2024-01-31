<?php

namespace App\Models;

use App\Models\Model;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserProfile extends Model {
    protected $table = 'user_profiles';

    protected $fillable = [
       'user_id', 
       'avatar', 
       'bio', 
       'location',
       'birthday',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id', 'profile_id');
    }

    public function favoriteGames() {
        return $this->hasMany(FavoriteGame::class, 'profile_id', 'id');
    }

    public function pcParts() : HasMany {
        return $this->hasMany(UserProfilePCPart::class, 'profile_id', 'id');
    }

    public function getBirthday() {
        return Carbon::parse($this->birthday)->format('m/d/Y');
    }

    public function canHaveMoreFavoriteGames() : bool {
        return $this->favoriteGames->count() < 12;
    }
}
