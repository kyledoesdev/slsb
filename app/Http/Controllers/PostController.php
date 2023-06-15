<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
    protected $post;

    public function __construct(Request $request) {
        if (get_route() !== 'post.store') {
            $this->post = Post::query()
                ->where('id', $request->route('id'))
                ->firstOrFail();
        }
    }

    public function store(CreatePostRequest $request) {
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'is_featured' => $request->input('is_featured'),
        ]);
        
        return response()->json([
            'redirect' => route('post.show', [
                'id' => $post->id,
                'post' => $post,
                'success' => 'New Post succesfully created.',
            ])
        ]);
    }

    public function show() {
        $comments = $this->post->comments()
            ->orderBy('created_at', 'DESC')
            ->with('user', 'user.profile', 'commentRatings')
            ->get();

        $topLevelComments = $comments->whereNull('parent_id');
        $commentsByParentId = $comments->groupBy('parent_id');

        return view('posts.show', [
            'post' => $this->post,
            'comments' => $topLevelComments,
            'commentsByParentId' => $commentsByParentId
        ]);
    }

    public function edit() {
        return view('posts.edit', ['post' => $this->post]);
    }

    public function update(UpdatePostRequest $request) {
        $this->post->updatePost($request->all());

        return response()->json([
            'redirect' => route('post.show', [
                'id' => $this->post->id,
                'post' => $this->post,
                'success' => 'Post succesfully updated.',
            ])
        ]);
    }

    public function destroy() {
        $this->post->delete();
        return redirect()->route('home')->with(['success' => 'Post succesfully deleted.']);
    }
}
