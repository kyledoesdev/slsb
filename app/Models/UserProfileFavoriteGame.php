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

        static::addGlobalScope('orderBy', fn (Builder $builder) => $builder->orderBy('game_title', 'ASC'));
    }
}
