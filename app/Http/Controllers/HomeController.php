<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller {

    public function index() {
        if (! auth()->check()) {
            return view('home', ['posts' => Post::with(['user', 'likes'])->get()]);
        }

        $posts = Post::query()->with(['user', 'likes'])->orderBy('created_at', 'DESC')->paginate(10);
        return view('home', ['posts' => $posts]);
    }
}
