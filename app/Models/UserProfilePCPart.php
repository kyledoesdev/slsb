<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserProfilePCPart extends Model {
    public $table = 'user_profile_pc_parts';

    protected $fillable = [
        'profile_id',
        'pc_part_id',
        'name',
    ];

    protected $with = [
        'pcPart'
    ];

    public static function boot() {
        parent::boot();

        static::addGlobalScope('default_order', fn($query) => $query->orderBy('pc_part_id', 'ASC'));
    }

    public function profile() : BelongsTo {
        return $this->belongsTo(UserProfile::class);
    }

    public function pcPart() : HasOne {
        return $this->hasOne(PCPart::class, 'id', 'pc_part_id');
    }
}
