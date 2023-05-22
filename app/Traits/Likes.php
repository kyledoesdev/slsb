<?php

namespace App\Traits;

use App\Models\Like;
use App\Models\Post;

trait Likes {

    /**
     * --------------------
     * 
     * Check to see if $this user has liked a post. If they have previously liked the post,
     * restore the record. Otherwise, create a new record that $this user liked the post.
     * 
     * -------------------
     * @param Post $post
     * @return bool 
     */
    public function like(Post $post) : bool {
        $like = Like::query()
            ->where('likers_user_id', $this->getId())
            ->where('post_id', $post->getId())
            ->withTrashed()
            ->first();

        $totalLikes = $post->getNumOfLikes();

        //if a like exists, restore it
        if($like != null) {
            $like->restore();
            $post->total_like_count = $totalLikes + 1;
            $post->save();
            return true;
        }

        $like = new Like;
        $like->likers_user_id = $this->getId();
        $like->post_id = $post->getId();
        $like->save();

        $post->total_like_count = $totalLikes + 1;
        $post->save();

        return true;
    }

    /**
     * --------------------
     * 
     * Check to see if $this user has liked a post. If they have not previously liked the post,
     * return false. Otherwise, soft delete the like record.
     * 
     * -------------------
     * @param Post $post
     * @return bool
     */
    public function unlike(Post $post) : bool {
        $like = Like::query()
            ->where('likers_user_id', $this->getId())
            ->where('post_id', $post->getId());

        $totalLikes = $post->getNumOfLikes();

        if ($like == null) {
            return false;
        }

        $like->delete();

        $post->total_like_count = $totalLikes - 1;
        $post->save();

        return true;
    }

    /**
     * --------------------
     * 
     * Check to see if $this user is liking a post. If a record of the user liking the post
     * does not exist, return false. Otherwise return true.
     * 
     * -------------------
     * @param Post $post
     * @return bool
     */
    public function isLiking(Post $post) : bool {
        return $post->likes->contains('likers_user_id', $this->getId());
    }

    /**
     * --------------------
     * 
     * Get all summed likes for a particular user's posts'.
     * 
     * -------------------
     * @return int
     */
    public function getAllLikes() : int {
        $likeCount = Post::query()
            ->where('user_id', $this->getId())
            ->pluck('total_like_count')
            ->toArray();

        return array_sum($likeCount);
    }
}