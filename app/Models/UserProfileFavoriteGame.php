<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class UserProfileFavoriteGame extends Model {
    use HasFactory;

    public $table = 'user_profile_favorite_games';

    protected $fillable = [
        'profile_id',
        'game_id',
        'game_title',
        'box_art_url',
        'formatted_box_art_url',
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($game) {
            if (Auth::check() && Auth::User()->isTwitchUser()) {
                $game->profile_id = auth()->user()->getUserProfileId();
            }
        });
    }
}
