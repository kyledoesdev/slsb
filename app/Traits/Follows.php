<?php

namespace App\Traits;

use App\Models\Follow;
use App\Models\User;

trait Follows {

    public function follow(User $userWeAreFollowing) : bool {
        $follow = Follow::query()
            ->withTrashed()
            ->where('follower_user_id', $this->id)
            ->where('followee_user_id', $userWeAreFollowing->id)
            ->first();

        if ($follow != null) {
            $follow->restore();
            return true;
        }

        $follow = new Follow;
        $follow->follower_user_id = $this->id; //$this user is a new follower
        $follow->followee_user_id = $userWeAreFollowing->id; //the user we are following is the followee
        $follow->save();

        return true;
    }

    public function unfollow(User $userWeAreUnFollowing) : bool {
        if(!$this->isFollowing($userWeAreUnFollowing)) {
            return false;
        }

        $follow = Follow::query()
            ->where('follower_user_id', $this->id)
            ->where('followee_user_id', $userWeAreUnFollowing->id);

        if ($follow == null) {
            return false;
        }

        $follow->delete();
        return true;
    }

    public function isFollowing(User $followee) : bool {
        //checking if $this user is a follower of the $followee
        $follow = Follow::query()
            ->where('follower_user_id', $this->id)
            ->where('followee_user_id', $followee->id)
            ->first();

        if ($follow == null) {
            return false;
        }

        return true;
    }
}