<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller {

    protected $post;

    public function __construct(Request $request) {
        if ($request->route('id') !== null) {
            $this->post = Post::where('id', $request->route('id'))->firstOrFail();
        }
    }

    public function create() {
        return view('posts.create');
    }

    public function store(CreatePostRequest $request) {
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'is_featured' => $request->input('is_featured') == 'on' ? true : false
        ]);
        
        return redirect(route('post.show', ['post' => $post]))->with(['success' => 'New Post succesfully created.']);
    }

    public function show($id) {
        return view('posts.show', ['post' => $this->post]);
    }

    public function edit($id) {
        return view('posts.edit', ['post' => $this->post]);
    }

    public function update(UpdatePostRequest $request, $id) {
        $this->post->updatePost($request->all());
        return redirect()->back()->with(['success' => 'Post succesfully updated.']);
    }

    public function destroy($id) {
        $this->post->delete();
        return redirect(route('home'))->with(['success' => 'Post succesfully deleted.']);
    }
}
