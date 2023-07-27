<?php

namespace App\Models;

use App\Models\Model;

class UserType extends Model {
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
