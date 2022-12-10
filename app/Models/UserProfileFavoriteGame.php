<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfileFavoriteGame extends Model {
    use HasFactory;

    public $table = 'user_profiles_favorite_games';

    protected $fillable = [
        'profile_id',
        'game_title',
        'box_art_url',
        'game_url',
    ];

    public static function boot() {
        static::creating(function ($game) {
            $game->profile_id = auth()->user()->getUserProfileId();
        });
    }
}
