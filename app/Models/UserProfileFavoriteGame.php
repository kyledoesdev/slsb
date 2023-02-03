<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Auth;

class UserProfileFavoriteGame extends Model {
    use HasFactory;
    use SoftDeletes;

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
            if (auth()->user()->isTwitchUser()) {
                $game->profile_id = auth()->user()->getUserProfileId();
            }
        });

        static::addGlobalScope('orderBy', 
            fn (Builder $builder) => $builder->orderBy('game_title', 'ASC')
        );
    }

    public static function getSpecificProfileFavoriteGame($gameId, $profileId, $trashed = false) {
        return self::query()
            ->when($trashed === true, fn ($query) => $query->withTrashed())
            ->where('game_id', $gameId)
            ->where('profile_id', $profileId)
            ->first();
    }

    public static function getAllProfileFavoriteGames($profileId, $trashed = false) {
        return self::query()
            ->when($trashed === true, fn ($query) => $query->withTrashed())
            ->where('profile_id', $profileId)
            ->get();
    }

    public static function createProfileFavoriteGame($fields) {
        self::updateOrCreate([
            'game_id' => $fields['game_id'],
        ], [
            'game_title' => $fields['game_title'],
            'box_art_url' => $fields['box_art_url'],
            'formatted_box_art_url' => 'https://static-cdn.jtvnw.net/ttv-boxart/'.$fields['game_id'].'-285x380.jpg',
        ]);
    }
}
