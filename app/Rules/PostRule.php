<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Post;

class PostRule implements Rule {

    protected $post;

    public function __construct() {
        /**
         * Returns a builder of if a post is featured or not.
         */
        $this->post = Post::query()
            ->where('user_id', auth()->id())
            ->where('is_featured', true);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {

        /**
         * If the post is featured and the checkbox is checked, update the old post to not be featured.
         */
        if ($this->post->exists() && $value != null) {
            $post = $this->post->first();
            $post->update([
                'is_featured' => false
            ]);
        }

        return $value != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'The validation error message.';
    }
}
