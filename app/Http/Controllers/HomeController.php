<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller {

    public function index() {

        if (auth()->id() == null) {
            return view('home', ['posts' => Post::all()]);
        }

        $posts = Post::query()->paginate(10);
        return view('home', ['posts' => $posts]);
    }
}
