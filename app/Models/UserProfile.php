<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserProfile extends Model {
    use HasFactory;

    public $table = 'user_profiles';

    protected $fillable = [
       'user_id', 
       'avatar', 
       'bio', 
       'location'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id', 'profile_id');
    }

    public function getId() {
        return $this->id;
    } 
}
