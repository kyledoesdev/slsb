<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model {
    use HasFactory;

    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const BASIC = 3;
    const GUEST = 4;

    public $table = 'user_types';
    protected $fillable = ['name'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
}
